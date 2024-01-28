<?php

namespace App\Http\Controllers;
use App\Models\Client;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $client = Client::where('user_id', auth()->user()->id)->get();
        return view('workspace.clients.index', compact('client'));
    }

    public function create(){
        return view('workspace.clients.create');
    }

    public function store(Request $request){
        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'no_telp' => $request->no_telp,
            'user_id' => auth()->user()->id,
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