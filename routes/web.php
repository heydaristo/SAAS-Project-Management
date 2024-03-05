<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Client;
use Carbon\Carbon;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\AdminTranscationController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\workspace\WorkspaceDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// login
Route::get('/', [UserController::class, 'login'])->name('/');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// accept
Route::get('workspace/contract/accepted/{id}', [ContractController::class,'accepted'])->name('workspace.contract.accepted');
Route::get('workspace/contract/successpaiddpcontract/{id}', [ContractController::class,'successpaiddpcontract'])->name('workspace.contract.successpaiddpcontract');
Route::get('workspace/quotation/accepted/{id}', [QuotationController::class,'accepted'])->name('workspace.quotation.accepted');
Route::get('workspace/quotation/successpaiddpcontract/{id}', [QuotationController::class,'successpaiddpcontract'])->name('workspace.quotation.successpaiddpcontract');
Route::get('workspace/invoice/paynow/{id}', [InvoiceController::class,'paynow'])->name('workspace.invoice.successpaiddpcontract');
Route::get('workspace/invoice/successpaid', [InvoiceController::class,'successpaid'])->name('workspace.invoice.succespaid');


Route::middleware(['guest'])->group(function () {
    Route::get('/', [UserController::class, 'login'])->name('/');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login-proses', [UserController::class, 'login_proses'])->name('login-proses');
    Route::get('/forgot-password', [UserController::class, 'forgotPasswordShow'])->name('forgot-password');
    Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->name('forgot-password.store');
    Route::get('/reset-password/{token}', [UserController::class, 'resetPassword'])->name('password.reset');
    Route::post('/reset-password', [UserController::class, 'resetPasswordProses'])->name('password.reset.store');
});

Route::middleware(['guest'])->name('password.reset')->prefix('reset-password')->group(function () {
    Route::get('/{token}', [UserController::class, 'resetPassword'])->name('');
});

Route::get('/loginadmin', [UserController::class, 'loginadmin'])->name('loginadmin')->middleware('guest');
Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register-proses', [UserController::class, 'register_proses'])->name('register-proses')->middleware('guest');


Route::group(['prefix' => 'workspace', 'middleware' => ['auth'], 'as' => 'workspace.'], function () {

    Route::get('/dashboard', [WorkspaceDashboardController::class, 'index'])->name('dashboard');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');

    Route::post('/clients/create', [ClientController::class, 'store'])->name('clients.store');

    Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

    Route::put('/clients/update/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/clients/delete/{id}', [ClientController::class, 'destroy'])->name('clients.delete');

    Route::get('/clients/show/{id}', [ClientController::class, 'show'])->name('clients.show');

    Route::get('/clients/checklimit/{id}', [ClientController::class, 'checklimit'])->name('clients.checklimit');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
    Route::put('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');
    Route::get('/projects/show/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/showadd', [ProjectController::class, 'showadd'])->name('projects.showadd');
    Route::get('/projects/detail/{id}', [ProjectController::class, 'detail'])->name('projects.detail');
    
    // quotations
    Route::get('/quotation', [QuotationController::class, 'index'])->name('quotation');
    Route::get('/quotation/showadd', [QuotationController::class, 'showadd'])->name('quotation.showadd');
    Route::get('/quotation/create', [QuotationController::class, 'create'])->name('quotation.create');
    Route::get('/quotation/edit/{id}', [QuotationController::class, 'edit'])->name('quotation.edit');
    Route::get('/quotation/update/{id}', [QuotationController::class, 'update'])->name('quotation.update');
    Route::get('/quotation/delete/{id}', [QuotationController::class, 'delete'])->name('quotation.delete');
    Route::get('/quotation/show/{id}', [QuotationController::class, 'show'])->name('quotation.show');
    Route::post('/quotation/store', [QuotationController::class, 'store'])->name('quotation.store');
    Route::get('/quotation/review/{id}', [QuotationController::class, 'review'])->name('quotation.review');
    Route::get('/quotation/pdf/{id}', [QuotationController::class, 'pdf'])->name('quotation.pdf');
    Route::post('/quotation/status/{id}', [QuotationController::class, 'status'])->name('quotation.pdf');
    Route::get('/quotation/editemail/{id}', [QuotationController::class, 'showEditEmail'])->name('quotation.editemail');
    Route::post('/quotation/finishemail/{id}', [QuotationController::class, 'finishemail'])->name('quotation.finishemail');
    Route::get('/quotation/showupdate/{id}', [QuotationController::class, 'showUpdate'])->name('quotation.showupdate');
    Route::put('/quotation/update/{id}', [QuotationController::class, 'update'])->name('quotation.update');
    Route::get('/quotation/showeditreview/{id}', [QuotationController::class,'showeditreview'])->name('quotation.showeditreview');
    Route::get('/quotation/editreview', [QuotationController::class,'editreview'])->name('quotation.editreview');
    Route::delete('/quotation/deleteQuotation/{id}', [QuotationController::class,'deleteQuotation'])->name('quotation.deleteQuotation');

    // contract
    Route::get('/contract', [ContractController::class, 'index'])->name('contract');
    Route::get('/contract/showadd', [ContractController::class, 'showadd'])->name('contract.showadd');
    Route::post('/contract/store', [ContractController::class, 'store'])->name('contract.store');
    Route::get('/contract/review/{id}', [ContractController::class, 'review'])->name('contract.review');
    Route::get('/contract/sendemail/{id}',[ContractController::class,'sendemail'])->name('contract.sendemail');
    Route::post('/contract/finishemail/{id}', [ContractController::class, 'finishemail'])->name('contract.finishemail');
    Route::get('/contract/showupdate/{id}', [ContractController::class, 'showUpdate'])->name('contract.showupdate');
    Route::put('/contract/update/{id}', [ContractController::class, 'update'])->name('contract.update');
    Route::get('/contract/showeditterm/{id}', [ContractController::class,'showeditterm'])->name('contract.showeditterm');
    Route::put('/contract/editterm/{id}', [ContractController::class,'editterm'])->name('contract.editterm');
    Route::delete('/contract/deleteContract/{id}', [ContractController::class, 'deleteContract'])->name('contract.deleteContract');    
    
    // invoice
    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/invoice/show/{id}', [InvoiceController::class, 'showId'])->name('invoices.show');
    Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::put('/invoice/update/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::get('/invoice/create', [InvoiceController::class, 'createInvoiceShowStep1'])->name('invoices.createInvoiceShowStep1');

    Route::get('/invoice/create', [InvoiceController::class, 'showAdd'])->name('invoices.showAdd');

    Route::post('invoce/create', [InvoiceController::class, 'postShowAdd'])->name('invoices.postShowAdd');

    Route::post('/invoice/print', [InvoiceController::class, 'printPDF'])->name('invoices.print');
    Route::delete('/invoice/delete/{id}', [InvoiceController::class, 'destroy'])->name('invoices.delete');
    Route::get('/invoice/createfromproject/{id}', [InvoiceController::class, 'showInvoiceFromProject'])->name('invoices.createfromproject');
    // Post Create Invoice
    Route::get('/invoice/create/preview', function () {
        return view('workspace.invoices.previewstep.preview');
    });
    Route::get('/invoice/sendemail/{id}',[InvoiceController::class,'sendemail'])->name('invoice.sendemail');
    Route::post('/invoice/finishemail/{id}', [InvoiceController::class, 'finishemail'])->name('invoice.finishemail');
    
    // Route::post('/invoice/create/')
    // End Post

    // settings

    Route::get('/invoice/review/', [InvoiceController::class, 'review'])->name('invoices.review');
    
    // change password

    Route::get('/settings/changepassword', [UserController::class, 'changePasswordShow'])->name('settings.changepassword');

    Route::get('/settings', [UserController::class, 'usersetting'])->name('settings');
    // change photo profile
    Route::post('/settings/update', [UserController::class, 'uploadProfile'])->name('settings.update');
    Route::post('/settings/upload', [UserController::class, 'uploadImage'])->name('settings.upload');
    // Delete profile
    Route::delete('/settings/delete', [UserController::class, 'deleteProfile'])->name('settings.deleteProfile');

    // change password
    Route::post('/settings/password', [UserController::class, 'changePassword'])->name('settings.password');
    // upgrade
    Route::get('/subscriptions/upgradeshow', [SubscriptionController::class, 'upgradeshow'])->name('subscriptions.upgradeshow');
    Route::get('/subscriptions/upgrade/{planid}', [SubscriptionController::class, 'upgrade'])->name('subscriptions.upgrade');
    Route::get('/subscriptions/bayar/{transactionid}', [SubscriptionController::class, 'bayar'])->name('subscriptions.bayar');
    Route::get('/subscriptions/success/{transactionid}', [SubscriptionController::class, 'success'])->name('subscriptions.success');

    // email

});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admindashboard', [DashboardController::class, 'index'])->name('dashboard');

    // user(freelance) management
    Route::get('/users', [UserController::class, 'index'])->name('user.show');
    Route::post('/users/create', [UserController::class, 'store'])->name('user.create');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('user.update');

    // plan management
    Route::get('/plans', [PlanController::class, 'index'])->name('plan.show');
    Route::post('/plans/create', [PlanController::class, 'store'])->name('plan.create');
    Route::delete('/plans/delete/{id}', [PlanController::class, 'destroy'])->name('plan.delete');
    Route::put('/plans/update/{id}', [PlanController::class, 'update'])->name('plan.update');

    // subscription management
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscription.show');
    Route::post('/subscriptions/create', [SubscriptionController::class, 'store'])->name('subscription.create');
    Route::delete('/subscriptions/delete/{id}', [SubscriptionController::class, 'destroy'])->name('subscription.delete');
    Route::put('/subscriptions/update/{id}', [SubscriptionController::class, 'update'])->name('subscription.update');

    // admin transaction management
    Route::get('/transactions', [AdminTranscationController::class, 'index'])->name('transaction.show');
    Route::post('/transactions/create', [AdminTranscationController::class, 'store'])->name('transaction.create');
    Route::delete('/transactions/delete/{id}', [AdminTranscationController::class, 'destroy'])->name('transaction.delete');
    Route::put('/transactions/update/{id}', [AdminTranscationController::class, 'update'])->name('transaction.update');

    Route::get('/transactions/listsubscriptions/{id}', [AdminTranscationController::class, 'listSubscriptions'])->name('transaction.listsubscriptions');

});

Route::group(
    ['prefix' => 'superadmin', 'middleware' => ['superadmin'], 'as' => 'superadmin.'],
    function () {
        Route::get('/', function () {
            // Hitung jumlah pengguna yang mendaftar dalam satu minggu terakhir
            $userCountLastWeek = User::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();

            // Hitung jumlah total pengguna
            $userCount = User::count();

            // Hitung jumlah klien yang didaftarkan dalam satu minggu terakhir
            $clientCountLastWeek = Client::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();

            // Hitung jumlah total klien
            $clientCount = Client::count();

            // Mengirimkan data ke tampilan Blade
            return view('superadmin.dashboard', [
                'userCountLastWeek' => $userCountLastWeek,
                'userCount' => $userCount,
                'clientCountLastWeek' => $clientCountLastWeek,
                'clientCount' => $clientCount
            ]);

        });

        Route::get('/dashboard', function () {
            // Hitung jumlah pengguna yang mendaftar dalam satu minggu terakhir
            $userCountLastWeek = User::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();

            // Hitung jumlah total pengguna
            $userCount = User::count();

            // Hitung jumlah klien yang didaftarkan dalam satu minggu terakhir
            $clientCountLastWeek = Client::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->count();

            // Hitung jumlah total klien
            $clientCount = Client::count();

            // Mengirimkan data ke tampilan Blade
            return view('superadmin.dashboard', [
                'userCountLastWeek' => $userCountLastWeek,
                'userCount' => $userCount,
                'clientCountLastWeek' => $clientCountLastWeek,
                'clientCount' => $clientCount
            ]);
        })->name('dashboard');

        // admin management
        Route::get('/admins', [AdminController::class, 'index'])->name('admin.show');
        Route::post('/admins/create', [AdminController::class, 'store'])->name('admin.create');
        Route::delete('/admins/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
        Route::put('/admins/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    }
);