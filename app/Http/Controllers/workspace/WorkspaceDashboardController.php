<?php

namespace App\Http\Controllers\workspace;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TasksClient;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Client;
use Carbon\Carbon;

class WorkspaceDashboardController extends Controller
{
    public function index()
    {
        $tasks = TasksClient::where('id_user', Auth()->user()->id)->paginate(10);
        $user = User::where('status', Auth()->user()->status);
        return view('workspace.dashboard', compact('tasks', 'user'));
    }
    public function storeTasks(Request $request) {
        // Ambil data dari request
        $tasks = $request->tasks;
        // Periksa jika judul kosong
        if (empty($tasks)) {
            // Jika judul kosong, tambahkan pesan ke dalam sesi flash
            $request->session()->flash('emptyData', 'Title is required!');
            return redirect()->route('workspace.dashboard');
        }
    
        // Buat data yang akan disimpan
        $data = [
            'tasks' => $tasks,
            'tasks_due_date' => Carbon::now(),
            'id_user' => Auth()->user()->id
        ];
    
        // Simpan data ke dalam database
        TasksClient::create($data);
    
        // Redirect ke halaman dashboard
        return redirect()->route('workspace.dashboard');
    }

    public function destroyTasks($id) {
        $tasks = TasksClient::find($id);
        $tasks->delete();
        return redirect()->back();
    }

    public function storeStatus($id,Request $request) {
         // Validasi request
         $request->validate([
            'status' => 'required|in:Active,Busy,Offline', // Pastikan status yang dipilih adalah salah satu dari Active, Busy, atau Offline
        ]);
        $data = [
            'status' => $request->status,
        ];
        // dd($data);
        User::find($id)->update($data);

        // Redirect atau kembali ke halaman sebelumnya
        Alert::success('Success Message', 'You have successfully to set status.');
        
        return redirect()->back();
    }
    
}
