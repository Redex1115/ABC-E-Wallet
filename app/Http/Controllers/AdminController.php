<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use DB;

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
            return redirect('admin/dashboard');
        }
        else{
            return redirect('admin/login')->with('msg', 'Invalid name/password!!');
        }
    }

    //Logout
    public function logout(){
        session()->forget(['adminData']);
        return redirect('admin/login');
    }

    //Show History
    public function showHistory(){
        $users = DB::table('wallets')
        ->leftjoin('users','wallets.holder_id','=','users.id')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->select('wallets.*','users.name as holderName', 'transactions.type as tType', 'transactions.amount as tAmount')
        ->get();

        return view('admin/transactionHistory', compact('users'));
    }

}
