<?php

namespace App\Http\Controllers;
use App\Models\Client;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $i = 1;
        $client = Client::where('user_id', auth()->user()->id)->get();
        $client = Client::paginate(10);
        return view('workspace.clients.index', compact('client', 'i'));
    }

    public function store(Request $request){
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'user_id' => auth()->user()->id,
        ];
        if(!$data) {
        return redirect()->route('workspace.clients');
        Alert::error('Failed Message', 'You have failed add new Client.');
        
        }else{
            Alert::success('Success Message', 'You have successfully add new Client.');
            Client::create($data);
            return redirect()->route('workspace.clients');
        }

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
        $client = Client::find($id);
        if($client->id_role == 1){
            Alert::error('Failed Message', 'You have failed delete Client.');
            return redirect()->route('workspace.clients')->with('failed','Gagal menghapus Client!');
        }

        $client->delete();
        Alert::success('Success Message', 'You have successfully delete.');
        return redirect()->route('workspace.clients');
    }
}
