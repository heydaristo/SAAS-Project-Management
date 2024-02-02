<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\User;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        // Hitung jumlah pengguna yang mendaftar dalam satu minggu terakhir
        $userCountLastWeek = User::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
        
        // Hitung jumlah total pengguna
        $userCount = User::count();
        
        // Hitung jumlah klien yang didaftarkan dalam satu minggu terakhir
        $clientCountLastWeek = Client::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();
        
        // Hitung jumlah total klien
        $clientCount = Client::count();
        
        // Mengirimkan data ke tampilan Blade
        $client = Client::where('user_id', auth()->user()->id)->get();
        $client = Client::paginate(5);
        return view('workspace.clients.index', [
            'userCountLastWeek' => $userCountLastWeek,
            'userCount' => $userCount,
            'clientCountLastWeek' => $clientCountLastWeek,
            'clientCount' => $clientCount,
            'client' => $client
        ]);
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
