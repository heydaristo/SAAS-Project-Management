<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotationController;

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

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register-proses', [UserController::class, 'register_proses'])->name('register-proses');


Route::group(['prefix' => 'workspace', 'middleware' => ['auth'], 'as' => 'workspace.'], function(){
    Route::get('/', function () {
        return view('workspace.dashboard');
    });
    Route::get('/dashboard', function () {
        return view('workspace.dashboard');
    })->name('dashboard');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');

    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

    Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

    Route::get('/clients/update/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::get('/clients/delete/{id}', [ClientController::class, 'delete'])->name('clients.delete');

    Route::get('/clients/show/{id}', [ClientController::class, 'show'])->name('clients.show');

    Route::get('/clients/store', [ClientController::class, 'store'])->name('clients.store');

    Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

    Route::get('/projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');

    Route::get('/projects/update/{id}', [ProjectController::class, 'update'])->name('projects.update');

    Route::get('/projects/delete/{id}', [ProjectController::class, 'delete'])->name('projects.delete');

    Route::get('/projects/show/{id}', [ProjectController::class, 'show'])->name('projects.show');

    Route::get('/projects/store', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/quotation', [QuotationController::class, 'index'])->name('quotation');

    Route::get('/quotation/create', [QuotationController::class, 'create'])->name('quotation.create');

    Route::get('/quotation/edit/{id}', [QuotationController::class, 'edit'])->name('quotation.edit');

    Route::get('/quotation/update/{id}', [QuotationController::class, 'update'])->name('quotation.update');

    Route::get('/quotation/delete/{id}', [QuotationController::class, 'delete'])->name('quotation.delete');

    Route::get('/quotation/show/{id}', [QuotationController::class, 'show'])->name('quotation.show');

    Route::get('/quotation/store', [QuotationController::class, 'store'])->name('quotation.store');

    Route::get('/quotation/pdf/{id}', [QuotationController::class, 'pdf'])->name('quotation.pdf');

    Route::post('/quotation/status/{id}', [QuotationController::class, 'status'])->name('quotation.pdf');
});