<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;
use App\Models\Client;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceDetail;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;




class ProjectController extends Controller
{
    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();

        // Mengambil proyek yang dimiliki oleh pengguna yang sedang login
        $projectmodels = DB::table('project_models')
            ->where('project_models.user_id', $userId) // Filter berdasarkan user_id
            ->join('clients', 'project_models.id_client', '=', 'clients.id')
            ->select('project_models.*', 'clients.name as name')
            ->orderBy('project_models.created_at', 'desc')
            ->paginate(5);

        // Mengambil klien yang dimiliki oleh pengguna yang sedang login
        $clients = Client::where('user_id', $userId)->get();

        return view('workspace.projects.index', compact('projectmodels', 'clients'));
    }

    public function showadd()
    {
        $userId = Auth::id();
        $clients = Client::where('user_id', $userId)->get();
        return view('workspace.projects.addproject', compact('clients'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string',
            'id_client' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'final_invoice_date' => 'required|date',
            'service_name' => 'required|array',
        ]);

        if ($validator->fails()) {
            $error = "You have failed add new projeect.\n" . strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->back()->withInput();
        }

        $user = Auth::user();

        $data['project_name'] = $request->project_name;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = 'ACTIVE';
        $data['id_client'] = $request->id_client;
        $data['user_id'] = $user->id;

        if (!$data) {
            $error = "You have failed add new projeect.\n" . strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('workspace.projects');
        } else {
            $result = ProjectModel::create($data);
            if ($result) {

                // Create each subscription
                $service = new Service();
                $service->id_quotation = 1;
                $service->id_project = $result->id;
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

                Alert::success('Success Message', 'You have successfully add new project.');
                return redirect()->route('workspace.projects');
            } else {
                Alert::error('Failed Message', 'You have failed add new project.');
                return redirect()->route('workspace.projects');
            }
        }
    }

    public function edit($id)
    {
        $project = ProjectModel::find($id);
        $clients = Client::where('user_id', Auth::id())->get();
        $user = User::find($project->user_id);
        $services = Service::where('id_project', $id)->get();
        // Memeriksa apakah array $services memiliki elemen atau tidak
        if (count($services) > 0) {
            // Jika array memiliki elemen, lanjutkan dengan query ke database
            $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        } else {
            // Jika array kosong, redirect ke halaman sebelumnya
            Alert::error('Failed Message', 'Can`t edit project because services null. Please contact administration.');
            return redirect()->back();
        }
        return view('workspace.projects.edit', compact('project', 'clients', 'user', 'services', 'serviceDetails'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string',
            'id_client' => 'required|exists:clients,id',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'final_invoice_date' => 'required|date',
            'service_name' => 'required|array',
        ]);

        if ($validator->fails()) {
            Alert::error('Failed Message', 'You have failed update project.' . $validator->errors());
            return redirect()->back()->with('error', $validator->errors());
        }

        $user = Auth::user();

        $project = ProjectModel::find($id);
        $project->project_name = $request->project_name;
        $project->id_client = $request->id_client;
        $project->start_date = $request->start_date;
        $project->final_invoice_date = $request->final_invoice_date;

        if ($request->has('end_date')) {
            $project->end_date = $request->input('end_date');
        } else {
            $project->end_date = null;
        }

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
            $project->require_deposit = true;
            $project->deposit_percentage = $depositPercentage;
            $project->deposit_amount = $depositAmount;
            $project->client_agrees_deposit = $request->has('client_agrees_deposit');
            $project->save();
        } else {
            $project->require_deposit = false;
            $project->deposit_percentage = null;
            $project->deposit_amount = null;
            $project->client_agrees_deposit = false;
            $project->save();
        }

        // Create each subscription
        $service = new Service();
        $service->id_project = $project->id;
        $service->id_quotation = 1;
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
        Alert::success('Pesan Berhasil', 'Anda berhasil mengubah proyek.');
        return redirect()->route('workspace.projects');
    }


    public function destroy($id)
    {
        // change service project id to 1
        $services = Service::where('id_project', $id)->get();
        foreach ($services as $service) {
            if ($service->id_quotation == 1 && $service->id_contract == 1) {
                // delete all service detailand services
                $service->id_project = 1;
                $service->save();
                $serviceDetails = ServiceDetail::where('id_service', $service->id)->get();
                foreach ($serviceDetails as $serviceDetail) {
                    $serviceDetail->delete();
                }
                $service->delete();
            }else{
                $service->id_project = 1;
                $service->save();
            }
        }

        // connected invoices change to NotsetProject
        $invoices = Invoice::where('id_project', $id)->get();
        foreach ($invoices as $invoice) {
            $invoice->id_project = 1;
            $invoice->save();
        }


        ProjectModel::find($id)->delete();

        Alert::success('Pesan Berhasil', 'Anda berhasil menghapus proyek.');
        return redirect()->route('workspace.projects');
    }

    public function updateNotes(Request $request, $id)
    {
        $project = ProjectModel::find($id);
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        $project->notes = $request->notes;
        $project->save();

        Alert::success('Success Message', 'You have successfully changed the notes.');
        return redirect()->back();
    }


    public function detail($id)
    {
        $project = ProjectModel::find($id);
        $client = Client::find($project->id_client);
        $invoices = Invoice::where('id_client', $client->id)->paginate(5);
        $services = Service::where('id_project', $id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        return view('workspace.projects.detailproject', compact('project', 'client', 'services', 'serviceDetails', 'invoices'));
    }
    public function updateName(Request $request, $id)
    {
        $project = ProjectModel::find($id);
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found');
        }

        $project->project_name = $request->project_name;
        $project->save();

        Alert::success('Success Message', 'You have successfully changed the name.');
        return redirect()->back();

    }

}
