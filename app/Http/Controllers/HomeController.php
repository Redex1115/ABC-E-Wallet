<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Log in user wallet
        $user = User::where('id',Auth::id())->first();

        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            $wallet = $user->createWallet([
                'name' => 'New Wallet',
                'slug' => 'my-wallet',
            ]);
        }

        //Log in user history
        $walletHistory = DB::table('wallets')
        ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        ->where('wallets.holder_id',Auth::user()->id)
        ->get();

        // $walletHistory = DB::table('wallets')
        // ->leftjoin('transactions','wallets.id','=','transactions.wallet_id')
        // ->leftjoin('transfers', 'wallet.id','=','transfers.from_id')
        // ->where(function($query){
        //      ->select('transfers.*','transfers.status as typeTransfer')
        //})
        // ->where('wallets.holder_id',Auth::user()->id)
        // ->get();

        //All users wallet
        $users = DB::table('users')->leftjoin('wallets','users.id','=','wallets.holder_id')->select('users.*','wallets.balance as wBalance')->get();

        return view('home', compact('wallet','walletHistory','user'));
    }

    public function depositForm(){
        return view('deposit');
    }

    public function withdrawForm(){
        return view('withdraw');
    }

    public function transferForm(Request $request, $id){
        
        $users = DB::table('users')->where('users.id',$id)->get();

        return view('transfer', compact('users'));
    }

    public function deposit(Request $request){
        $user = User::where('id',Auth::id())->first();
        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('home');
        }
        $wallet -> deposit($request -> amount);

        return redirect('home');
    }
    
    public function withdraw(Request $request){
        $user = User::where('id',Auth::id())->first();
        if($user-> hasWallet('default')){
            $wallet = $user->wallet;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('home');
        }
        $wallet -> withdraw($request -> amount);

        return redirect('home');
    }

    public function transfer(Request $request){
        $first = User::where('id',Auth::id())->first();
        $last = User::where('id', $request -> userID)->first();
        $first->getKey() !== $last->getKey();

        if($first-> hasWallet('default')){
            $walletFirst = $first->wallet;
        }
        elseif($first-> hasWallet('my-wallet')){
            $walletFirst = $first->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('home');
        }

        if($last-> hasWallet('default')){
            $walletLast = $last->wallet;
        }
        elseif($last-> hasWallet('my-wallet')){
            $walletLast = $last->getWallet('my-wallet');
        }
        else{
            Session::flash('msg','You dint have any wallet please create one');
            return redirect('home');
        }

        $walletFirst -> transfer($walletLast, $request->amount);

        return redirect('home');
    }
}
