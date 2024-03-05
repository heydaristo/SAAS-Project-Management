<?php

namespace App\Http\Controllers;

use App\Mail\QuotationMail;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\User;
use App\Models\Client;
use App\Models\ProjectModel;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Service;
use App\Models\ServiceDetail;

class QuotationController extends Controller
{
    public function index()
    {
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

    public function showadd()
    {
        $userId = Auth::id();
        $clients = Client::where('user_id', $userId)->get();
        return view('workspace.quotation.addqc', compact('clients'));
    }

    public function create()
    {
        return view('workspace.quotation.create');
    }

    public function store(Request $request)
    {
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
        } else {
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

    public function review($id)
    {
        $quotation = Quotation::find($id);
        $services = Service::where('id_quotation', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        $client = Client::find($quotation->id_client);
        return view('workspace.quotation.review', compact('quotation', 'services', 'serviceDetails', 'client'));
    }

    public function edit($id)
    {
        $client = Client::find($id);

        return view('workspace.clients.edit', compact('client'));
    }

    public function show($id)
    {
        $client = Client::find($id);

        return view('workspace.clients.show', compact('client'));
    }

    public function status($id, $status)
    {
        // update status
        $quotation = Quotation::find($id);
        $quotation->status = $status;
        $quotation->save();
        return redirect()->route('workspace.quotation');
    }

    public function showEditEmail($id)
    {
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
    public function showUpdate($id)
    {
        $quotation = Quotation::findOrFail($id);
        $clients = Client::all();
        $user = User::find($quotation->id_user);
        $services = Service::where('id_quotation', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        return view('workspace.quotation.editquotation', compact('quotation', 'clients', 'user', 'services', 'serviceDetails'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'project_name' => 'required|string',
            'id_client' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'final_invoice_date' => 'required|date',
            // Add more validation rules as needed
        ]);

        // Find the contract to update
        $quotation = Quotation::findOrFail($id); // assuming $id is the contract ID being updated

        // Update contract details
        $quotation->quotation_name = $request->input('project_name');
        $quotation->start_date = $request->input('start_date');
        $quotation->end_date = $request->input('end_date');
        $quotation->id_client = $request->input('id_client');
        $quotation->final_invoice_date = $request->input('final_invoice_date');

        // Update the user ID only if necessary
        if ($quotation->id_user !== Auth::id()) {
            $quotation->id_user = Auth::id();
        }

        // Update deposit information if provided
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

            // Update contract with deposit information
            $quotation->require_deposit = true;
            $quotation->deposit_percentage = $depositPercentage;
            $quotation->deposit_amount = $depositAmount;
            $quotation->client_agrees_deposit = $request->has('client_agrees_deposit');
        } else {
            $quotation->require_deposit = false;
            $quotation->deposit_percentage = null;
            $quotation->deposit_amount = null;
            $quotation->client_agrees_deposit = false;
        }

        // Save the updated contract
        $quotation->save();

        // ambil service 
        $service = Service::where('id_quotation', $quotation->id)->first();

        // hapus yang lama 
        ServiceDetail::where('id_service', $service->id)->delete();

        // masukkan yang baru
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

        return redirect()->route('workspace.quotation.showeditreview', $quotation->id);
    }

    public function showeditreview($id)
    {
        $quotation = Quotation::findOrFail($id);
        $services = Service::where('id_contract', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        $total = $serviceDetails->sum('price');
        $quotation->total = $total;
        $client = Client::find($quotation->id_client);
        $user = User::find($quotation->id_user);
        return view('workspace.quotation.editreview', compact('quotation', 'services', 'serviceDetails', 'client', 'user'));
    }

    public function editreview()
    {
        Alert::success('Success Message', 'You have successfully update quotation.');
        // Redirect to the contract review page
        return redirect()->route('workspace.quotation');
    }

    public function accepted($id)
    {
        $quotation = Quotation::findOrFail($id);
        // check if contract need to pay firstly or not
        if ($quotation->client_agrees_deposit == true) {
            // get subscription detail
            $services = Service::where('id_quotation', $id)->get();
            $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
            $client = Client::find($quotation->id_client);
            $user = User::find($quotation->id_user);


            // page pembayaran
            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.isProduction');
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('midtrans.is3ds');


            $params = array(
                'transaction_details' => array(
                    'order_id' => rand(),
                    'gross_amount' => $quotation->deposit_amount,
                ),
                'customer_details' => array(
                    'first_name' => $user->fullname,
                    'email' => $user->email,
                ),
            );

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $quotation['snap_token'] = $snapToken;

            return view('workspace.quotation.paidacceptpage', compact('quotation'));
        } else if ($quotation->client_agrees_deposit == false) {
            // page terimakasih
            $quotation->status = "APPROVED";
            $quotation->save();
            // create project based on contract
            $data['project_name'] = $quotation->quotation_name;
            $data['start_date'] = date('Y-m-d');
            $data['end_date'] = $quotation->end_date;
            $data['status'] = 'ACTIVE';
            $data['id_client'] = $quotation->id_client;
            $data['user_id'] = $quotation->id_user;

            ProjectModel::create($data);

            // update service id project
            $service = Service::where('id_quotation', $id)->first();
            $service->id_project = $quotation->id_project;
            $service->save();

            return view('workspace.quotation.acceptpage');
        }
        // create project based on contract
    }

    public function successpaiddpcontract($id)
    {
        $quotation = Quotation::find($id);
        $quotation->status = "APPROVED";


        // create project based on contract
        $data['project_name'] = $quotation->quotation_name;
        $data['start_date'] = date('Y-m-d');
        $data['end_date'] = $quotation->end_date;
        $data['status'] = 'ACTIVE';
        $data['id_client'] = $quotation->id_client;
        $data['user_id'] = $quotation->id_user;

        $project = ProjectModel::create($data);

        $quotation->id_project = $project->id;
        $quotation->save();

        // update service id project
        $service = Service::where('id_quotation', $id)->first();
        $service->id_project = $quotation->id_project;
        $service->save();

        return view('workspace.quotation.acceptpage');
    }

    public function deleteQuotation(Request $request, $id)
    {
        $quotation = Quotation::find($id);
        $service = Service::where('id_quotation', $id)->first();
        $service->id_quotation = 1;
        $service->save();
        $quotation->delete();
        Alert::success('Success Message', 'You have successfully delete quotation.');
        return redirect()->route('workspace.quotation');
    }
}
