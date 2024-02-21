<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProjectModel;
use App\Models\Client;
use PDF; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $invoices = DB::table('invoices')
        ->where('invoices.user_id', $userId)
        ->join('project_models', 'invoices.id_project', '=', 'project_models.id')
        ->join('clients', 'invoices.id_client', '=', 'clients.id')
        ->select('invoices.*', 'project_models.project_name as project_name', 'clients.name as name')
        // ->get();
        ->paginate(5); // Menggunakan paginate dengan 10 item per halaman
    
        // Periksa dan ubah status invoice jika due date telah terlewati
        foreach ($invoices as $invoice) {
        // Periksa apakah tanggal sekarang lebih besar dari due date pada invoice
        if (Carbon::now()->greaterThan($invoice->due_date)) {
            $invoice->status = 'Inactive'; // Jika melebihi, ubah status menjadi 'Inactive'
        }
}

        $project = ProjectModel::all();
        $clients = Client::all();
    
        return view('workspace.invoices.index', compact('invoices', 'project', 'clients'));

    }

    public function showId($id)
    {
     $userId = auth()->user()->id;
        

    $invoice = DB::table('invoices')
        ->where('invoices.user_id', $userId)
        ->where('invoices.id', $id) // Filter berdasarkan ID invoice
        ->join('project_models', 'invoices.id_project', '=', 'project_models.id')
        ->join('clients', 'invoices.id_client', '=', 'clients.id')
        ->select('invoices.*', 'project_models.project_name as project_name',
         'clients.*')
        ->first(); // Menggunakan first() karena Anda hanya ingin satu invoice

  
        if (!$invoice) {
        // Jika bukan pemiliknya, kembalikan response tidak diizinkan
        return abort(403, 'Not Found');
    }

    // Kembalikan view dengan data invoice
    return view('workspace.invoices.show', compact('invoice'));
    }

    public function printPDF(Request $request)
    {
        $request->validate([
            'invoice_id' => 'required|integer|exists:invoices,id'
        ]);
    
        $invoiceId = $request->input('invoice_id');
        $userId = auth()->user()->id;
    
        $invoice = DB::table('invoices')
            ->where('invoices.user_id', $userId)
            ->where('invoices.id', $invoiceId) // Filter berdasarkan ID invoice
            ->join('project_models', 'invoices.id_project', '=', 'project_models.id')
            ->join('clients', 'invoices.id_client', '=', 'clients.id')
            ->select('invoices.*', 'project_models.project_name as project_name',
                'clients.name as name', 'clients.address as address', 'clients.email as email')
            ->first(); // Menggunakan first() karena Anda hanya ingin satu invoice
    
        if (!$invoice) {
            // Jika bukan pemiliknya, kembalikan response tidak diizinkan
            return abort(403, 'Not Found');
        }
    
        $pdf = PDF::loadView('workspace.invoices.print', compact('invoice'));
    
        // Mengatur nama file PDF
        $filename = 'invoice_' . $invoice->name . '_' . date('Ymd') . '.pdf';
    
        // Kembalikan file PDF untuk diunduh
        return $pdf->download($filename);
        Alert::success('Success Message', 'You have successfully download pdf.');
    }
    public function store(Request $request)
    {
        // Validasi data dari formulir
        $validator = Validator::make($request->all(), [
            'id_project' => 'required|exists:project_models,id',
            'id_client' => 'required|exists:clients,id',
            'status' => 'required',
            'due_date' => 'required|date',
            'total' => 'required|numeric',
        ]);
    
        $user = Auth::user();
        // Data yang akan disimpan
        $data = [
            'id_project' => $request->id_project,
            'id_client' => $request->id_client,
            'issued_date' => Carbon::now(),
            'status' => $request->status,
            'due_date' => $request->due_date,
            'total' => $request->total,
            'invoice_pdf' => '1',
            'user_id' => $user->id,
        ];
        // Simpan data ke dalam database
        if (Invoice::create($data)) {
            // Jika berhasil, kembalikan dengan pesan sukses
            return redirect()->route('workspace.invoice')->with('success', 'You have successfully added new invoice.');
            Alert::success('Success Message', 'You have successfully added new invoice.');
        } else {
            // Jika gagal, kembalikan dengan pesan gagal
            return redirect()->route('workspace.invoice')->with('error', 'Failed to add new invoice.');
            Alert::error('Error Message', 'Failed to add new invoice.');
            
        }
    }

    public function createInvoiceShowStep1() {
        $userId = Auth::id();

        $invoices = DB::table('invoices')
        ->where('invoices.user_id', $userId)
        ->join('project_models', 'invoices.id_project', '=', 'project_models.id')
        ->join('clients', 'invoices.id_client', '=', 'clients.id')
        ->select('invoices.*', 'project_models.project_name as project_name', 'clients.name as name')
        // ->get();
        ->paginate(5); // Menggunakan paginate dengan 10 item per halaman
    
        $project = ProjectModel::all();
        $clients = Client::all();

        return view('workspace.invoices.createstep1', compact('invoices', 'project', 'clients'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'id_project' => ['required'],
            'id_client' => ['required'],
            'status' => ['required'],
            'due_date' => ['required'],
            'total' => ['required'],
        ]);
        $data = [
            'id_project' => $request->id_project,
            'id_client' => $request->id_client,
            'status' => $request->status,
            'due_date' => $request->due_date,
            'total' => $request->total,
        ];
       
        if(!$data) {
            Alert::error('Failed Message', 'You have failed to edit invoice.');
            return redirect()->route('workspace.invoice');
        } else {
            Alert::success('Success Message', 'You have successfully to edit invoice.');
            Invoice::find($id)->update($data);
            return redirect()->route('workspace.invoice');

        }
    }
    public function destroy(Request $request, $id){
        $invoiceId = $request->route('id');
        $userId = auth()->id();
        
        $invoice = Invoice::find($invoiceId);
        
        if (!$invoice) {
            abort(404);
        }

        // Jika invoice tidak ditemukan atau bukan milik pengguna yang sedang login
        if ($invoice->user_id !== auth()->id()) {
            abort(403, 'Not Found.');
        }
        $invoice->delete();
        Alert::success('Success Message', 'You have successfully delete.');
        return redirect()->route('workspace.invoice');
    }
    
}
