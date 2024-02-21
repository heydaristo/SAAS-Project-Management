<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;

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
}
