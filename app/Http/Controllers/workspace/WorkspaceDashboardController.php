<?php

namespace App\Http\Controllers\workspace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;

class WorkspaceDashboardController extends Controller
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
    
        // Mengirimkan data ke tampilan Blade
        return view('workspace.dashboard', [
            'userCountLastWeek' => $userCountLastWeek,
            'userCount' => $userCount,
            'clientCountLastWeek' => $clientCountLastWeek,
            'clientCount' => $clientCount
        ]);
    }
}
