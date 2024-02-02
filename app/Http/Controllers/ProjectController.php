<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectModel;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;



class ProjectController extends Controller
{
    public function index(){
        $projectmodels = DB::table('project_models')
        ->join('users', 'project_models.user_id', '=', 'users.id')
        ->join('clients', 'project_models.id_client', '=', 'clients.id')
        ->select('project_models.*', 'users.fullname as fullname', 'clients.name as name')
        ->paginate(5); // Menggunakan paginate dengan 10 item per halaman
    
        $freelances = User::where('id_role', 3)->get();
        $clients = Client::all();
    
        return view('workspace.projects.index', compact('projectmodels', 'freelances', 'clients'));
    
    }

    public function create(){
        return view('workspace.projects.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'project_name' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
            'status' => ['required'],
            'id_client' => ['required'],
            'user_id' => ['required'],
        ]);
        if ($validator->fails()) {
            $error = "You have failed add new projeect.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('workspace.projects');
        }

        $data['project_name'] = $request->project_name;
        $data['start_date'] = $request->start_date;
        $data['end_date'] = $request->end_date;
        $data['status'] = $request->status;
        $data['id_client'] = $request->id_client;
        $data['user_id'] = $request->user_id;

        if(!$data){
            $error = "You have failed add new projeect.\n".strval($validator->errors());
            Alert::error('Failed Message', $error);
            return redirect()->route('workspace.projects');
        }else{
            // dd($data);
            $result = ProjectModel::create($data);
            if($result){
                Alert::success('Success Message', 'You have successfully add new project.');
                return redirect()->route('workspace.projects');
            }else{
                Alert::error('Failed Message', 'You have failed add new project.');
                return redirect()->route('workspace.projects');
            }
        }
    }

    public function edit($id){
        $client = Client::find($id);

        return view('workspace.clients.edit', compact('client'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'project_name' => ['required'],
          'start_date' => ['required'],
           'end_date' => ['required'],
         'status' => ['required'],
           'id_client' => ['required'],
           'user_id' => ['required'],
        ]);

        $data = [
            'project_name' => $request->project_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => $request->status,
            'id_client' => $request->id_client,
            'user_id' => $request->user_id,
        ];
        if(!$data) {
            Alert::error('Failed Message', 'You have failed to edit project.');
            return redirect()->route('workspace.projects');
        } else {
            Alert::success('Success Message', 'You have successfully to edit project.');
            ProjectModel::find($id)->update($data);
            return redirect()->route('workspace.projects');

        }
    }


    public function destroy($id){
        ProjectModel::find($id)->delete();

        Alert::success('Success Message', 'You have successfully to delete project.');
        return redirect()->route('workspace.projects');
    }
}
