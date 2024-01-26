<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    echo "Selamat Datang";
});

// login

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-proses', [UserController::class, 'login_proses'])->name('login-proses');

Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register-proses', [UserController::class, 'register_proses'])->name('register-proses');


Route::group(['prefix' => 'workspace', 'middleware' => ['auth'], 'as' => 'workspace.'], function(){
    Route::get('/', function () {
        return view('dashboard');
    });
    Route::get('/dashboard', function () {
        return view('workspace.dashboard');
    })->name('dashboard');

    Route::get('/clients', [ClientController::class, 'index'])->name('clients');

    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

    Route::get('/clients/edit/{id}', [ClientController::class, 'edit'])->name('clients.edit');

    Route::get('/clients/update/{id}', [ClientController::class, 'update'])->name('clients.update');

    Route::get('/clients/delete/{id}', [ClientController::class, 'delete'])->name('clients.delete');

    // Route::get('/projects', function () {
    //     return view('workspace.projects');
    // })->name('projects');

});