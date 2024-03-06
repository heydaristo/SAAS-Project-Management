<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\TasksClient;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
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
            'name' => ['required'],
            'email' => ['required', 'email:dns', 'unique:clients,email'],
            'address' => ['required'],
            'no_telp' => ['required'],
        ]);
        if ($validator->fails()) {
            Alert::error('Failed Message', 'You have failed to edit client.')->withErrors($validator);
            return redirect()->route('workspace.clients');
        }
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
        ];

        if (!$data) {
            Alert::error('Failed Message', 'You have failed to edit client.');
            return redirect()->route('workspace.clients');
        } else {
            Alert::success('Success Message', 'You have successfully to edit client.');
            Client::find($id)->update($data);
            return redirect()->route('workspace.clients');

        }
        return redirect()->route('workspace.clients');
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

    public function show($id)
    {
        $user = Auth::user();
        $client = Client::where('user_id', $user->id)->findOrFail($id);
        $tasks = TasksClient::where('id_client', $id)->get();
    
    
        return view('workspace.clients.show', compact('client', 'tasks'));
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
