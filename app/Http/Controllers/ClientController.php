<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\TasksClient;
use App\Models\Invoice;
use App\Models\ProjectModel;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        // Hitung jumlah pengguna yang mendaftar dalam satu minggu terakhir
        $userCountLastWeek = User::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();

        // Hitung jumlah total pengguna
        $userCount = User::count();

        // Hitung jumlah klien yang didaftarkan dalam satu minggu terakhir
        $clientCountLastWeek = Client::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();

        // Hitung jumlah total klien
        $clientCount = Client::count();

        $userId = Auth::id();

        // if the request has data_count_shows
        if ($request->input('data_count_shows') != null) {
        $dataCountShows = $request->input('data_count_shows');
        $client = Client::where('user_id', $userId)->paginate($dataCountShows);
        return view('workspace.clients.index', [
            'userCountLastWeek' => $userCountLastWeek,
            'userCount' => $userCount,
            'clientCountLastWeek' => $clientCountLastWeek,
            'clientCount' => $clientCount,
            'client' => $client,
            'only5' => Auth::user()->id_role == 3 ? true : false,
        ]);
        }

           // if the request has search
       if ($request->input('search') != null) {
        $client = Client::where('user_id', Auth::id())->where('name', 'like', '%' . $request->search . '%')->paginate(5);
        return view('workspace.clients.index', [
            'userCountLastWeek' => $userCountLastWeek,
            'userCount' => $userCount,
            'clientCountLastWeek' => $clientCountLastWeek,
            'clientCount' => $clientCount,
            'client' => $client,
            'only5' => Auth::user()->id_role == 3 ? true : false,
        ]);
    }

        if (Auth::user()->id_role == 3) {
            $client = Client::where('user_id', $userId)->limit(5)->get();
        } else {
            $client = Client::where('user_id', $userId)->paginate(5);
        }
        return view('workspace.clients.index', [
            'userCountLastWeek' => $userCountLastWeek,
            'userCount' => $userCount,
            'clientCountLastWeek' => $clientCountLastWeek,
            'clientCount' => $clientCount,
            'client' => $client,
            'only5' => Auth::user()->id_role == 3 ? true : false,
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'state' => $request->state,
            'city' => $request->city,
            'region' => $request->region,
            'postal_code' => $request->postal_code,
            'no_telp' => $request->no_telp,
            'user_id' => auth()->user()->id,
            'email' => $request->email,
        ];
        if (!$data) {
            Alert::error('Failed Message', 'You have failed add new Client.');
            return redirect()->route('workspace.clients');

        } else {
            Alert::success('Success Message', 'You have successfully add new Client.');
            Client::create($data);
            return redirect()->route('workspace.clients');
        }

    }

    public function edit($id)
    {
        $client = Client::find($id);

        return view('workspace.clients.edit', compact('client'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email:dns', 'unique:clients,email'],
            'address' => ['required'],
            'no_telp' => ['required'],
            'postal_code' => ['required'],
            'state' => ['required'],
            'city' => ['required'],
            'region' => ['required'],
        ]);
        if ($validator->fails()) {
            Alert::error('Failed Message', 'You have failed to edit client.')->withErrors($validator);
            return redirect()->back();
        }
        $data = [
            'email' => $request->email,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'postal_code' => $request->postal_code,
            'state' => $request->state,
            'city' => $request->city,
            'region' => $request->region,
        ];
        if (!$data) {
            Alert::error('Failed Message', 'You have failed to edit client.');
            return redirect()->back();
        } else {
            Alert::success('Success Message', 'You have successfully to edit client.');
            Client::find($id)->update($data);
            return redirect()->back();

        }
        return redirect()->route('workspace.clients.show', ['#tabs-address'], $id);
    }

    public function updateNotes(Request $request, $id) {
        $client = Client::find($id);
        if (!$client) {
            return redirect()->back()->with('error', 'Client not found');
        }
    
        $client->notes = $request->notes;
        $client->save();
    
        Alert::success('Success Message', 'You have successfully changed the notes.');
        return redirect()->back();
    }

    public function tasks(Request $request, $id) {
        $client = Client::find($id);
        $user = Auth()->user()->id;
        $data = [
            'tasks' => $request->tasks,
            'tasks_due_date' => $request->tasks_due_date,
            'id_client' => $id,
            'id_user' => $user
        ];
        if($request->tasks === null || $request->tasks_due_date === null) {
            Alert::error('Failed Message', 'You have failed to add tasks.');
            return redirect()->back();
        } else {
            if (!$data) {
                Alert::error('Failed Message', 'You have failed to add tasks.');
                return redirect()->route('workspace.clients.show', $id);
            } else {
                TasksClient::create($data);
                return redirect()->route('workspace.clients.show', $id);
    
            }
            return redirect()->route('workspace.clients.show', $client->id);
        }
        
    }

    public function updateNameClient(Request $request, $id){
        $client = Client::find($id);
        if (!$client) {
            return redirect()->back()->with('error', 'Client not found');
        }
    
        $client->name = $request->name;
        $client->save();
    
        Alert::success('Success Message', 'You have successfully changed the name.');
        return redirect()->back();

    }

    public function show($id)
    {
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->findOrFail($id);
        $invoices = Invoice::where('id_client', $client->id)->paginate(5);
        $projectmodels = ProjectModel::where('id_client', $id)->paginate(10);
        $tasks = TasksClient::where('id_client', $id)->get();
    
    
        return view('workspace.clients.show', compact('client', 'tasks', 'projectmodels', 'invoices'));
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        if ($client->id_role == 1) {
            Alert::error('Failed Message', 'You have failed delete Client.');
            return redirect()->route('workspace.clients')->with('failed', 'Gagal menghapus Client!');
        }

        $client->delete();
        Alert::success('Success Message', 'You have successfully delete.');
        return redirect()->route('workspace.clients');
    }

    public function tasksDestroy($id){
        $tasks = TasksClient::find($id);
        $tasks->delete();
        return redirect()->back();
    }

    public function checklimit($id)
    {
        $user = User::find($id);
        if ($user->id_role == 3) {
            // check bila sudah limit 
            $client = Client::where('user_id', $id)->count();
            if ($client < 5) {
                return back()->with('aman', 'aman');
            } else {
                return back()->with('limit', 'limit');
            }
        } else {
            return back()->with('aman', 'aman');
        }
    }


}
