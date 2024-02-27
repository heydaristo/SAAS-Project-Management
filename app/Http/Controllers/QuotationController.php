<?php

namespace App\Http\Controllers;

use App\Mail\QuotationMail;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Service;
use App\Models\ServiceDetail;

class QuotationController extends Controller
{
    public function index(){
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
        // Mengambil proyek yang dimiliki oleh pengguna yang sedang login
        $quotations = DB::table('quotations')
            ->where('quotations.id_user', $userId) // Filter berdasarkan user_id
            ->join('clients', 'quotations.id_client', '=', 'clients.id')
            ->select('quotations.*', 'clients.name as name')
            ->paginate(5);

        
        // Mengambil klien yang dimiliki oleh pengguna yang sedang login
        $clients = Client::where('user_id', $userId)->get();
        return view('workspace.quotation.index', compact('quotations', 'clients'));
    }

    public function showadd(){
        $userId = Auth::id();
        $clients = Client::where('user_id', $userId)->get();
        return view('workspace.quotation.addqc', compact('clients'));
    }

    public function create(){
        return view('workspace.quotation.create');
    }

    public function store(Request $request){
        // Validate the request data
        $request->validate([
            'project_name' => 'required|string',
            'id_client' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'final_invoice_date' => 'required|date',
            // Add more validation rules as needed
        ]);

        // Create a new Quotation instance
        $quotation = new Quotation();
        $quotation->quotation_name = $request->input('project_name');
        $quotation->start_date = $request->input('start_date');
        
        if ($request->has('end_date')) {
            $quotation->end_date = $request->input('end_date');
        } else {
            $quotation->end_date = null;
        }

        $quotation->status = 'SENT';
        $quotation->quotation_pdf = '';
        $quotation->id_client = $request->input('id_client');
        $quotation->id_user = Auth::id();
        $quotation->id_project = 1;
        $quotation->final_invoice_date = $request->input('final_invoice_date');


        // deposit
        // Check if deposit information is provided
        if ($request->has('require_deposit')) {
            // Validate deposit percentage
            $request->validate([
                'deposit_percentage' => 'required|numeric|min:0|max:100',
            ]);

            // Calculate deposit amount
            $totalCost = 0;
            $servicePrices = $request->input('service_price');
            foreach ($servicePrices as $price) {
                $totalCost += $price;
            }
            $depositPercentage = $request->input('deposit_percentage');
            $depositAmount = ($depositPercentage / 100) * $totalCost;

            // Update the quotation with deposit information
            $quotation->require_deposit = true;
            $quotation->deposit_percentage = $depositPercentage;
            $quotation->deposit_amount = $depositAmount;
            $quotation->client_agrees_deposit = $request->has('client_agrees_deposit');
            $quotation->save();
        }else{
            $quotation->require_deposit = false;
            $quotation->deposit_percentage = null;
            $quotation->deposit_amount = null;
            $quotation->client_agrees_deposit = false;
            $quotation->save();
        }

        // Create each subscription
        $service = new Service();
        $service->id_quotation = $quotation->id;
        $service->id_project = 1;
        $service->id_contract = 1;
        $service->save();

        // create each subscription detail
        $serviceNames = $request->input('service_name');
        $servicePrices = $request->input('service_price');
        $serviceFeeMethods = $request->input('service_fee_method');
        $serviceDescriptions = $request->input('service_description');
        foreach ($serviceNames as $index => $serviceName) {
            $serviceDetail = new ServiceDetail();
            $serviceDetail->id_service = $service->id;
            $serviceDetail->service_name = $serviceName;
            $serviceDetail->price = $servicePrices[$index];
            $serviceDetail->pay_method = $serviceFeeMethods[$index];
            $serviceDetail->description = $serviceDescriptions[$index];
            $serviceDetail->save();
        }
        
        // Redirect to the quotation index page
        return redirect()->route('workspace.quotation.review', $quotation->id);
    }

    public function review($id){
        $quotation = Quotation::find($id);
        $services = Service::where('id_quotation', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        $client = Client::find($quotation->id_client);
        return view('workspace.quotation.review', compact('quotation', 'services', 'serviceDetails', 'client'));
    }

    public function edit($id){
        $client = Client::find($id);

        return view('workspace.clients.edit', compact('client'));
    }

    public function update(Request $request, $id){
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
        ];

        Client::find($id)->update($data);

        return redirect()->route('workspace.clients');
    }

    public function show($id){
        $client = Client::find($id);

        return view('workspace.clients.show', compact('client'));
    }

    public function status($id, $status){
       // update status
         $quotation = Quotation::find($id);
            $quotation->status = $status;
            $quotation->save();
        return redirect()->route('workspace.quotation');
    }

    public function showEditEmail($id){
        $quotation = Quotation::find($id);
        $client = Client::find($quotation->id_client);
        return view('workspace.quotation.editemail', compact('quotation', 'client'));
    }

    public function finishemail(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        $client = Client::find($quotation->id_client);
        $user = User::find($quotation->id_user);
        $services = Service::where('id_quotation', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        Mail::to($request->recipient)->send(new QuotationMail($quotation, $client, $user, $serviceDetails, $request->subject, $request->message));
        Alert::success('Success Message', 'You have successfully send email.');
        return redirect()->route('workspace.quotation');
    }
}
