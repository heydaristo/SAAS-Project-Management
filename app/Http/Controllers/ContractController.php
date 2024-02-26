<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Contract;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class ContractController extends Controller
{
    public function index(){
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
        // Mengambil proyek yang dimiliki oleh pengguna yang sedang login
        $contracts = DB::table('contracts')
            ->where('contracts.id_user', $userId) // Filter berdasarkan user_id
            ->join('clients', 'contracts.id_client', '=', 'clients.id')
            ->select('contracts.*', 'clients.name as name')
            ->paginate(5);

        
        // Mengambil klien yang dimiliki oleh pengguna yang sedang login
        $clients = Client::where('user_id', $userId)->get();
        return view('workspace.contracts.index', compact('contracts','clients'));
    }

    public function showadd(){
        $userId = Auth::id();
        $clients = Client::where('user_id', $userId)->get();
        return view('workspace.contracts.addc', compact('clients'));
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
        $contract = new Contract();
        $contract->contract_name = $request->input('project_name');
        $contract->start_date = $request->input('start_date');
        
        if ($request->has('end_date')) {
            $contract->end_date = $request->input('end_date');
        } else {
            $contract->end_date = null;
        }

        $contract->status = 'SENT';
        $contract->contract_pdf = 'DEFAULT';
        $contract->id_client = $request->input('id_client');
        $contract->id_user = Auth::id();
        $contract->id_project = 1;
        $contract->final_invoice_date = $request->input('final_invoice_date');


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
            $contract->require_deposit = true;
            $contract->deposit_percentage = $depositPercentage;
            $contract->deposit_amount = $depositAmount;
            $contract->client_agrees_deposit = $request->has('client_agrees_deposit');
            $contract->save();
        }else{
            $contract->require_deposit = false;
            $contract->deposit_percentage = null;
            $contract->deposit_amount = null;
            $contract->client_agrees_deposit = false;
            $contract->save();
        }

        // Create each subscription
        $service = new Service();
        $service->id_contract = $contract->id;
        $service->id_project = 1;
        $service->id_quotation = 1;
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
        return redirect()->route('workspace.contract.review', $contract->id);
    }

    public function review($id){
        $contract = Contract::findOrFail($id);
        $services = Service::where('id_contract', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        $total = $serviceDetails->sum('price');
        $contract->total = $total;  
        $client = Client::find($contract->id_client);
        $user = User::find($contract->id_user);
        return view('workspace.contracts.contract', compact('contract', 'services', 'serviceDetails', 'client', 'user'));
    }

    public function sendemail($id){
        $contract = Contract::findOrFail($id);
        $client = Client::find($contract->id_client);
        return view('workspace.contracts.sendmail',compact('contract','client'));
    }

    public function finishemail(Request $request, $id){
        
        $contract = Contract::findOrFail($id);
        $client = Client::find($contract->id_client);
        $user = User::find($contract->id_user);
        $services = Service::where('id_contract', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        Mail::to($request->recipient)->send(new MyEmail($contract,$client,$user,$serviceDetails));
        Alert::success('Success Message', 'You have successfully send email.');
        return redirect()->route('workspace.contract');
    }

}
