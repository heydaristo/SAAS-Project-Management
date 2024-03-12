<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProjectModel;
use App\Models\Client;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\ServiceDetail;
use App\Models\Invoice;
use Illuminate\Support\Facades\Mail;

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
            ->orderBy('invoices.created_at', 'desc')
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

    public function showInvoiceFromProject($id)
    {
        // $id milik project
        $project = ProjectModel::find($id);
        $client = Client::find($project->id_client);
        $services = Service::where('id_project', $id)->get();
        // Memeriksa apakah array $services memiliki elemen atau tidak
        if (count($services) > 0) {
            // Jika array memiliki elemen, lanjutkan dengan query ke database
            $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        } else {
            // Jika array kosong, redirect ke halaman sebelumnya
            Alert::error('Failed Message', 'Services null.');
            return redirect()->back();
        }
        // create invoice based on project
        $invoice = new Invoice();
        $invoice->id_project = $project->id;
        $invoice->id_client = $client->id;
        $invoice->status = 'PENDING';
        $invoice->issued_date = Carbon::now();
        $invoice->due_date = $project->final_invoice_date;

        // calculate service detail
        $total = 0;
        foreach ($serviceDetails as $serviceDetail) {
            $total += $serviceDetail->price;
        }
        $invoice->total = $total;
        $invoice->user_id = Auth::id();
        $invoice->invoice_pdf = '2';
        $invoice->save();

        return view('workspace.invoices.createfromproject', compact('invoice', 'project', 'client', 'services', 'serviceDetails'));
    }

    public function showInvoiceFromClient($id)
    {
        // $id milik client
        $client = Client::find($id);
        $project = ProjectModel::find($client->id_project);
        $services = Service::where('id_project', $id)->get();
        // Memeriksa apakah array $services memiliki elemen atau tidak
        if (count($services) > 0) {
            // Jika array memiliki elemen, lanjutkan dengan query ke database
            $serviceDetails = ServiceDetail::where('id_service', $services[0]->id)->get();
        } else {
            // Jika array kosong, redirect ke halaman sebelumnya
            Alert::error('Failed Message', 'Services null.');
            return redirect()->back();
        }
        // create invoice based on project
        $invoice = new Invoice();
        $invoice->id_project = $project->id;
        $invoice->id_client = $client->id;
        $invoice->status = 'PENDING';
        $invoice->issued_date = Carbon::now();
        $invoice->due_date = $project->final_invoice_date;

        // calculate service detail
        $total = 0;
        foreach ($serviceDetails as $serviceDetail) {
            $total += $serviceDetail->price;
        }
        $invoice->total = $total;
        $invoice->user_id = Auth::id();
        $invoice->invoice_pdf = '2';
        $invoice->save();

        return view('workspace.invoices.createfromclient', compact('invoice', 'project', 'client', 'services', 'serviceDetails'));
    }

    public function showId($id)
    {
        $userId = Auth::id();

        $invoice = Invoice::find($id);

        $client = Client::find($invoice->id_client); // Menggunakan find untuk mencari berdasarkan ID

        $project = ProjectModel::findOrFail($invoice->id_project);

        $services = Service::where('id_project', $project->id)->get();

        $serviceDetails = ServiceDetail::where('id_service', $services->first()->id)->get();

        // Simpan ID invoice yang dipilih
        $this->selectedInvoiceId = $id;

        // dd($client);
        if (!$invoice) {
            // Jika bukan pemiliknya, kembalikan response tidak diizinkan
            return abort(403, 'Not Found');
        }

        // Kembalikan view dengan data invoice
        return view('workspace.invoices.show', compact('invoice', 'services', 'client', 'project', 'serviceDetails'));
    }

    public function printPDF(Request $request)
    {
        $invoiceId = $request->input('invoice_id');
        $userId = auth()->user()->id;

        $invoice = Invoice::find($invoiceId);
        if (!$invoice) {
            // Jika bukan pemiliknya, kembalikan response tidak diizinkan
            return abort(403, 'Not Found');
        }

        $project = ProjectModel::find($invoice->id_project);
        $client = Client::find($invoice->id_client);
        $service = Service::where('id_project', $project->id)->first();
        $serviceDetails = ServiceDetail::where('id_service', $service->id)->get();

        $pdf = PDF::loadView('workspace.invoices.print', compact('invoice', 'project', 'client', 'serviceDetails'));

        // Mengatur nama file PDF
        $filename = 'invoice_' . $invoice->name . '_' . date('Ymd') . '.pdf';

        // Kembalikan file PDF untuk diunduh
        Alert::success('Success Message', 'You have successfully download pdf.');
        return $pdf->download($filename);
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
            Alert::success('Success Message', 'You have successfully added new invoice.');
            return redirect()->route('workspace.invoice')->with('success', 'You have successfully added new invoice.');
        } else {
            // Jika gagal, kembalikan dengan pesan gagal
            Alert::error('Error Message', 'Failed to add new invoice.');
            return redirect()->route('workspace.invoice')->with('error', 'Failed to add new invoice.');

        }
    }


    public function showAdd()
    {
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

        return view('workspace.invoices.showadd', compact('invoices', 'project', 'clients'));
    }

    public function postShowAdd(Request $request)
    {
        // Validasi data formulir jika diperlukan
        // $request->validate([
        //     ''
        // ]);

        // Ambil nilai active_card dari request
        $activeCard = $request->input('active_card');

        // Lakukan sesuatu berdasarkan nilai active_card
        switch ($activeCard) {
            case 1:
                // Lakukan sesuatu jika card 1 yang aktif
                $invoice = new Invoice();
                $invoice->id_project = $request->input('id_project');
                return redirect()->route('workspace.invoices.review', $invoice->id);
                break;
            case 2:
                // Lakukan sesuatu jika card 2 yang aktif
                break;
            case 3:
                // Lakukan sesuatu jika card 3 yang aktif
                break;
            default:
                // Handle jika tidak ada card yang aktif
                break;
        }
    }
    public function review($id)
    {
        return view('workspace.invoices.review');
    }

    public function update(Request $request, $id)
    {
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

        if (!$data) {
            Alert::error('Failed Message', 'You have failed to edit invoice.');
            return redirect()->route('workspace.invoice');
        } else {
            Alert::success('Success Message', 'You have successfully to edit invoice.');
            Invoice::find($id)->update($data);
            return redirect()->route('workspace.invoice');

        }
    }
    public function destroy(Request $request, $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            Alert::error('Failed Message', 'You have failed to delete invoice.');
            return redirect()->route('workspace.invoice');
        } else {
            $invoice->delete();
            Alert::success('Success Message', 'You have successfully deleted.');
            return redirect()->route('workspace.invoice');
        }
    }

    public function sendemail($id)
    {
        $invoice = Invoice::find($id);
        $client = Client::find($invoice->id_client);
        $project = ProjectModel::find($invoice->id_project);

        return view('workspace.invoices.sendmail', compact('invoice', 'project', 'client'));
    }

    public function finishemail(Request $request, $id)
    {
        $userId = User::find(Auth::id());
        $invoice = Invoice::find($id);
        $invoice->status = 'SENT';
        $invoice->save();
        $client = Client::find($invoice->id_client); // Menggunakan find untuk mencari berdasarkan ID
        $project = ProjectModel::findOrFail($invoice->id_project);
        $services = Service::where('id_project', $project->id)->get();
        $serviceDetails = ServiceDetail::where('id_service', $services->first()->id)->get();
        Mail::to($request->recipient)->send(new InvoiceMail($invoice, $client, $userId, $project, $serviceDetails, $request->message, $request->subject));
        Alert::success('Success Message', 'You have successfully send email.');
        return redirect()->route('workspace.invoice');
    }

    public function paynow($id)
    {
        $invoice = Invoice::find($id);
        $user = User::find($invoice->user_id);
        $invoice->status = 'PENDING';
        // check if contract need to pay firstly or not
        // page pembayaran

        // page pembayaran
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $invoice->total,
            ),
            'customer_details' => array(
                'first_name' => $user->fullname,
                'email' => $user->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $invoice->snap_token = $snapToken;
        $invoice->save();
        return view('workspace.invoices.paidacceptpage', compact('invoice'));
    }

    public function successpaid($id)
    {
        $invoice = Invoice::find($id);
        $project = ProjectModel::find($invoice->id_project);
        $invoice->status = 'PAID';

        // create new transaction
        $transaction = new Transaction();
        $transaction->id_project = $invoice->id_project;
        $transaction->id_invoice = $invoice->id;
        $transaction->id_user = $invoice->user_id;
        $transaction->is_income = 1;
        $transaction->source = $invoice->id_client;
        $transaction->description = 'Invoice ' . $project->project_name;
        $transaction->category = 'Invoice';
        $transaction->amount = $invoice->total;
        $transaction->created_date = Carbon::now();
        $transaction->save();

        return view('workspace.quotation.acceptpage');
    }
}
