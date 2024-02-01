<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\DB;


class ProjectController extends Controller
{
    public function index(){
        $projectmodels = DB::table('project_models')
        ->join('users', 'project_models.user_id', '=', 'users.id')
        ->join('clients', 'project_models.id_client', '=', 'clients.id')
        ->select('project_models.*', 'users.fullname as fullname', 'clients.name as name')
        ->get();
        $freelances = User::where('id_role', 3)->get();
        $clients = Client::all();
        return view('workspace.projects.index', compact('projectmodels', 'freelances', 'clients'));
    }

    public function create(){
        return view('workspace.projects.create');
    }

    public function store(Request $request){
        $data = [
            'project_name' => $request->project_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'end_date' => $request->end_date,
            'end_date' => $request->end_date,

        ];

        Client::create($data);

        return redirect()->route('workspace.clients');
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


    public function destroy($id){
        Client::find($id)->delete();

        return redirect()->route('workspace.clients');
    }
}
