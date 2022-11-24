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
            'password' => 'required',
            'loginID' => 'required',
        ]);

        if($request->has('rememberme')){
            Cookie::queue('loginID',$request->loginID,1440); //1440 means it stays for 24 hours
            Cookie::queue('password',$request->password,1440);
        }

        $adminData = User::where(['loginID' => $request->loginID, 'password' => sha1($request->password)])->get();
        session(['adminData' => $adminData]);

        $credentials = $request->only('password','loginID');

        if(Auth::attempt($credentials))
        {
            if(Auth::user()->isAdmin()){
                Toastr::success('You Successfully LogIn', 'Admin Login', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
                return redirect('admin/dashboard');
            }
        }
        else{
            Toastr::error('Wrong User Name and Password', 'Invalid Input', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
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
        $users = DB::table('transactions')
        ->leftjoin('users','transactions.payable_id','=','users.id')
        ->select('transactions.*','users.loginID as holderName')
        ->get();


        return view('admin/transactionHistory', compact('users'));
    }

    //Show Profile
    public function showProfile(){
        return view('admin/profile');
    }

    //Show Wallet
    public function showWallet(){
        $users = User::all();
        foreach($users as $user){
            if($user -> hasWallet('my-wallet')){
                
                $wallet = $user -> getWallet('my-wallet');
            }
            else{
                $wallet = $user->createWallet([
                    'name' => 'New Wallet',
                    'slug' => 'my-wallet',
                ]);
            }
        }
        

        $wallets = DB::table('wallets')
        ->leftjoin('users','wallets.holder_id','=','users.id')
        ->select('wallets.*','users.loginID as uName')
        ->get();
        return view('admin/wallet', compact('users','wallets'));
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

        if($request -> amount > $user -> credit_limit){
            $remaining = $user -> credit_limit - $wallet -> balance;
            Toastr::info('Your credit limit is RM'.$user -> credit_limit.'</br>You can deposit RM'.$remaining.' more','Over Limit', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('admin/wallet');
        }
        else{
            $wallet -> depositFloat($request -> amount);
            Toastr::success('Wallet Deposit RM'.$request -> amount.' Successfully', 'Deposit To '.$user -> loginID, ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('admin/wallet');
        }
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

        $wallet -> withdrawFloat($request -> amount);
        Toastr::success('Wallet Withdraw RM'.$request -> amount.' Successfully', 'Withdraw From '.$user -> loginID, ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/wallet');
    }

    //Show Test Blade
    public function showTest(){
        $parents = User::where('created_by',0)->get();
        return view('admin/test', compact('parents'));
    }

}
