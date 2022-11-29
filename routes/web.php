<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthController;

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
//Login & Logout
Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/login', [AdminController::class, 'check_login']);
Route::get('admin/logout', [AdminController::class, 'logout']);
//Dashboard & Table & Transaction History & Profile & Wallet
Route::get('admin/dashboard', function(){return view('admin/dashboard');});

Route::get('admin/transactionHistory', [AdminController::class, 'showHistory']);
Route::get('admin/profile', [AdminController::class, 'showProfile']);
Route::get('admin/wallet', [AdminController::class, 'showWallet']);

//Display Info & Update
Route::get('admin/table/{id}', [AdminController::class, 'showTable']);
Route::post('admin/update', [AdminController::class, 'update']);

//Deposit (Testing)
Route::post('check-out/deposit', [AdminController::class, 'deposit']);

//Withdraw (Testing)
Route::post('check-out/withdraw', [AdminController::class, 'withdraw']);

// -----Auth-----
//Login & Logout
Route::get('login', [AuthController::class, 'index']);
Route::post('post-login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout']);
//Register  
Route::post('post-registration', [AuthController::class, 'postRegistration']);

// -----Branch-----


// -----Manager-----


// -----Member-----
//Transfer
Route::get('/transfer/{id}', [HomeController::class, 'transferForm']);
Route::post('check-out/transfer', [HomeController::class, 'transfer']);

// -----For All-----
//Welcome Page
Route::get('/', function () {return view('welcome');});

//View
Route::get('profile', [ProfileController::class, 'view']);

//Testing page
Route::get('admin/test', [AdminController::class, 'showTest']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
