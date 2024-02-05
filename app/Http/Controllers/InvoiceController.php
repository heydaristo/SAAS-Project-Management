<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProjectModel;
use App\Models\Client;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = DB::table('invoices')
        ->join('project_models', 'invoices.id_project', '=', 'project_models.id')
        ->join('clients', 'invoices.id_client', '=', 'clients.id')
        ->select('invoices.*', 'project_models.project_name as project_name', 'clients.name as name')
        // ->get();
        ->paginate(1); // Menggunakan paginate dengan 10 item per halaman
    
        // Periksa dan ubah status invoice jika due date telah terlewati
        foreach ($invoices as $invoice) {
        // Periksa apakah tanggal sekarang lebih besar dari due date pada invoice
        if (Carbon::now()->greaterThan($invoice->due_date)) {
            $invoice->status = 'Inactive'; // Jika melebihi, ubah status menjadi 'Inactive'
        }
}

        $project = ProjectModel::all();
        $clients = Client::all();
    
        return view('workspace.invoice.index', compact('invoices', 'project', 'clients'));

    }
    public function store(Request $request)
    {
        // Validasi data dari formulir
        $validator = Validator::make($request->all(), [
            'id_project' => 'required|exists:projects,id',
            'id_client' => 'required|exists:clients,id',
            'status' => 'required',
            'due_date' => 'required|date',
            'total' => 'required|numeric',
        ]);
    
        // Validasi issued_date menggunakan aturan kustom
        $validator->sometimes('issued_date', 'required|date|before_or_equal:today', function ($input) {
            return !$input->has('issued_date') || !isset($input->issued_date); // Validasi hanya berlaku jika issued_date ada dalam input
        });
    
        // Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan kesalahan
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Data yang akan disimpan
        $data = [
            'id_project' => $request->id_project,
            'id_client' => $request->id_client,
            'issued_date' => Carbon::now(),
            'status' => $request->status,
            'due_date' => $request->due_date,
            'total' => $request->total,
            'invoice_pdf' => '1',
        ];
    
        // Simpan data ke dalam database
        if (Invoice::create($data)) {
            // Jika berhasil, kembalikan dengan pesan sukses
            return redirect()->route('workspace.invoice')->with('success', 'You have successfully added new invoice.');
        } else {
            // Jika gagal, kembalikan dengan pesan gagal
            return redirect()->route('workspace.invoice')->with('error', 'Failed to add new invoice.');
        }
    }
    
}
