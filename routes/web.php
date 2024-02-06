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
Route::get('/', [UserController::class, 'login'])->name('/ ');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-proses', [UserController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/loginadmin', [UserController::class, 'loginadmin'])->name('forgot-password');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register-proses', [UserController::class, 'register_proses'])->name('register-proses');


Route::group(['prefix' => 'workspace', 'middleware' => ['auth'], 'as' => 'workspace.'], function(){

    Route::get('/dashboard', [WorkspaceDashboardController::class, 'index'])->name('dashboard');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');

    Route::post('/clients/create', [ClientController::class, 'store'])->name('clients.store');

    Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

    Route::put('/clients/update/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::delete('/clients/delete/{id}', [ClientController::class, 'destroy'])->name('clients.delete');

    Route::get('/clients/show/{id}', [ClientController::class, 'show'])->name('clients.show');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

    // Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');

    Route::put('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');

    Route::delete('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('projects.delete');

    Route::get('/projects/show/{id}', [ProjectController::class, 'show'])->name('projects.show');

    Route::post('/projects/store', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('/quotation', [QuotationController::class, 'index'])->name('quotation');

    Route::get('/quotation/create', [QuotationController::class, 'create'])->name('quotation.create');

    Route::get('/quotation/edit/{id}', [QuotationController::class, 'edit'])->name('quotation.edit');

    Route::get('/quotation/update/{id}', [QuotationController::class, 'update'])->name('quotation.update');

    Route::get('/quotation/delete/{id}', [QuotationController::class, 'delete'])->name('quotation.delete');

    Route::get('/quotation/show/{id}', [QuotationController::class, 'show'])->name('quotation.show');

    Route::get('/quotation/store', [QuotationController::class, 'store'])->name('quotation.store');

    Route::get('/quotation/pdf/{id}', [QuotationController::class, 'pdf'])->name('quotation.pdf');

    Route::post('/quotation/status/{id}', [QuotationController::class, 'status'])->name('quotation.pdf');

    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');

    Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoices.store');


    // settings

    Route::get('/settings', [UserController::class, 'usersetting'])->name('settings');
    // change photo profile
    Route::post('/settings/upload', [UserController::class, 'uploadImage'])->name('settings.upload');
    // Delete profile
    Route::delete('/settings/delete', [UserController::class, 'deleteProfile'])->name('settings.deleteProfile');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin'], 'as' => 'admin.'], function(){
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

Route::group(['prefix' => 'superadmin', 'middleware' => ['superadmin'], 'as' => 'superadmin.'], function(){
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