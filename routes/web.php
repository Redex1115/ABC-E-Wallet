<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// -----Admin-----
//Login
Route::get('admin/login', [AdminController::class, 'login']);
Route::post('admin/login', [AdminController::class, 'check_login']);

//Logout
Route::get('admin/logout', [AdminController::class, 'logout']);

//Dashboard
Route::get('admin/dashboard', function(){return view('admin/dashboard');});
//Table
Route::get('admin/table', function(){return view('admin/table');});
//Transaction History
Route::get('admin/transactionHistory', [AdminController::class, 'showHistory']);

// -----Branch-----


// -----Manager-----
//Deposit
Route::get('deposit', [HomeController::class, 'depositForm']);
Route::post('check-out/deposit', [HomeController::class, 'deposit']);

//Withdraw
Route::get('withdraw', [HomeController::class, 'withdrawForm']);
Route::post('check-out/withdraw', [HomeController::class, 'withdraw']);

// -----Member-----
//Transfer
Route::get('/transfer/{id}', [HomeController::class, 'transferForm']);
Route::post('check-out/transfer', [HomeController::class, 'transfer']);

// -----For All-----
//Welcome Page
Route::get('/', function () {return view('welcome');});

//View
Route::get('profile/{id}', [ProfileController::class, 'view']);


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
