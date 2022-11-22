<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Cookie;

class AdminController extends Controller
{
    //Login
    public function login(){
        return view('admin/login');
    }

    //Check Login
    public function check_login(Request $request){

        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where(['name' => $request->name, 'password' => sha1($request->password)])->count();

        if($request->has('rememberme')){
            Cookie::queue('name',$request->name,1440); //1440 means it stays for 24 hours
            Cookie::queue('password',$request->password,1440);
        }

        if($admin > 0){
            $adminData = Admin::where(['name' => $request->name, 'password' => sha1($request->password)])->get();
            session(['adminData' => $adminData]);
            Toastr::success('You Successfully LogIn', 'Admin Login', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('admin/dashboard');
        }
        else{
            Toastr::error('Invalid name/password!!', 'Wrong Info', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-bottom-right"]);
            return redirect('admin/login');
        }
    }

    //Logout
    public function logout(){
        session()->forget(['adminData']);
        Toastr::info('You have log out admin account', 'Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/login');
    }

    //Show History
    public function showHistory(){
        $users = DB::table('wallets')
        ->leftjoin('users','wallets.holder_id','=','users.id')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->select('wallets.*','users.name as holderName', 'transactions.type as tType', 'transactions.amount as tAmount')
        ->orderBy('wallets.holder_id', 'asc')
        ->orderBy('transactions.type','asc')
        ->get();

        $counts = $users -> count();

        return view('admin/transactionHistory', compact('users','counts'));
    }

    //Show Profile
    public function showProfile(){
        return view('admin/profile');
    }

    //Show Wallet
    public function showWallet(){
        $wallets = DB::table('wallets')->get();
        $users = User::all();

        return view('admin/wallet', compact('wallets', 'users'));
    }

    //Deposit
    public function deposit(Request $request){
        $user = User::where('id',$request -> userID)->first();
        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Toastr::info('You do not have any wallet', 'Missing Wallet', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('home');
        }
        $wallet -> deposit($request -> amount);

        Toastr::success('Wallet Deposit RM'.$request -> amount.' Successfully', 'Deposit To '.$user -> name, ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/wallet');
    }

    //Withdraw
    public function withdraw(Request $request){
        $user = User::where('id',$request -> userID)->first();
        $walletBalance = DB::table('wallets')->where('holder_id',$request->userID)->first();
        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Toastr::info('You do not have any wallet', 'Missing Wallet', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('admin/wallet');
        }

        if($walletBalance->balance < $request->amount){
            Toastr::error('You do not have enough funds to withdraw.</br> Wallet Balance: RM' .$walletBalance->balance, 'Insufficient funds', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-bottom-right"]);
            return redirect('admin/wallet');
        }

        $wallet -> withdraw($request -> amount);
        Toastr::success('Wallet Withdraw RM'.$request -> amount.' Successfully', 'Withdraw From '.$user -> name, ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/wallet');
    }
}
