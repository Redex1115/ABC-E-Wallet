<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Info;
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
                $wallet = Auth::user()->wallet;
                $wallet->balance;
                Toastr::success('You Successfully LogIn', 'Admin Login', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->isBranch()){
                Toastr::success('You Successfully LogIn', 'Branch Login', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->isAgent()){
                Toastr::success('You Successfully LogIn', 'Agent Login', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
                return redirect('admin/dashboard');
            }
        }
        else{
            Toastr::error('Wrong User Name and Password', 'Invalid Input', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return view('admin.login');
        }
    }

    //Logout
    public function logout(){
        session()->forget(['adminData']);
        Toastr::info('You have log out admin account', 'Successfully', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/login');
    }

    //Show Profile
    public function showProfile(){
        return view('admin/profile');
    }

    //Show Table
    public function showTable($id){
        //treeview
        $parents = User::where('id',Auth::user()->id)->get();
        // $parents = User::where('created_by',0)->get();
        
        //info
        $users = DB::table('users')
        ->leftjoin('infos','users.account_id','=','infos.userID')
        ->select('users.*','infos.ic as userIc','infos.handphone_number as userHp','infos.address as userAddress','infos.remark as userRemark','infos.status as userStatus')
        ->where('users.account_id',$id)
        ->get();

        //user permission
        $user_permissions = DB::table('user_permissions')
        ->leftjoin('permissions','user_permissions.permission_id','=','permissions.id')
        ->select('user_permissions.*', 'permissions.permission_name as pName')
        ->where('user_permissions.user_id',$id)
        ->get(); 

        return view('admin/table', compact('parents','users','user_permissions'));
    }

    //Update info
    public function update(Request $request){
        $info = Info::where('userID', $request->accID)->first();

        $request -> validate([
            'accID' => 'required',
            'ic' => 'nullable',
            'phoneNO' => 'nullable',
            'address' => 'nullable',
            'remark' => 'nullable',
            'status' => 'nullable',
        ]);

        if(!$info){
            $addInfo = Info::create([
                'userID' => $request -> accID,
                'ic' => $request -> ic,
                'handphone_number' => $request -> phoneNO,
                'address' => $request -> address,
                'remark' => $request -> remark,
                'status' => $request -> status,
            ]);
        }
        else{
            $info -> ic = $request -> ic;
            $info -> handphone_number = $request -> phoneNO;
            $info -> address = $request -> address;
            $info -> remark = $request -> remark;
            $info -> status = $request -> status;
            $info -> save();  
        }
        
        Toastr::success('You have successfully update user info', 'Update Info', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return back();
    }

    //Show Wallet
    public function showWallet(){
        $self = User::where('account_id','=',Auth::user()->account_id)->get();
        $others = User::where('account_id','!=',Auth::user()->account_id)->get();

        $user_permissions = DB::table('user_permissions')
        ->leftjoin('permissions','user_permissions.permission_id','=','permissions.id')
        ->select('user_permissions.*', 'permissions.permission_name as pName')
        ->where('user_permissions.user_id',Auth::user()->account_id)
        ->get(); 

        $wallets = DB::table('wallets')
        ->leftjoin('users','wallets.holder_id','=','users.id')
        ->select('wallets.*','users.loginID as uName')
        ->orderBy('users.loginID','asc')
        ->get();

        return view('admin/wallet', compact('wallets','user_permissions','self','others'));
    }

    //Deposit
    public function deposit(Request $request){

        $user = User::where('id',$request -> userID)->first();
        if($wallet = $user->wallet){
            $wallet = $user->wallet;
            $wallet->balance;
        }
        elseif($user-> hasWallet('my-wallet')){
            $wallet = $user->getWallet('my-wallet');
        }
        else{
            Toastr::info('You do not have any wallet', 'Missing Wallet', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('admin/wallet');
        }

        if($request -> amount + ($wallet -> balance/100) > $user -> credit_limit){
            $remaining = $user -> credit_limit - ($wallet -> balance/100);
            Toastr::info('Your credit limit is RM'.$user -> credit_limit.'</br>You can deposit RM'.$remaining.' more','Over Limit', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return redirect('admin/wallet');
        }
        else{
            $wallet -> depositFloat($request -> amount,['deposit']);
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

        $wallet -> withdrawFloat($request -> amount,['withdraw']);
        Toastr::success('Wallet Withdraw RM'.$request -> amount.' Successfully', 'Withdraw From '.$user -> loginID, ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
        return redirect('admin/wallet');
    }

    //Transfer
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

        if($last-> hasWallet('default')){
            $walletLast = $last->wallet;
        }
        elseif($last-> hasWallet('my-wallet')){
            $walletLast = $last->getWallet('my-wallet');
        }

        $walletFirst -> transferFloat($walletLast, $request->amount);

        return back();
    }

    //Show Test Blade
    public function showTest(Request $request){

        $parents = User::leftjoin('wallets', function($join){
            $join ->on('users.id','=','wallets.holder_id');
        })
        ->select('users.*','wallets.balance as wBalance')
        ->orderBy('loginID','asc')
        ->where('created_by',0)
        ->get();

        return view('admin/test', compact('parents'));
    }

    public function getChildren($id){
        $children = User::where('created_by',$id)->get();
        $name = [];
        foreach($children as $child){
            $name[] = ['id'=>$child -> id,'name' => $child -> loginID,'balance'=>number_format($child ->balance/100,2),'created_by' => $child -> created_by]; 
        }
        return $name;
    }

    //Show Sub Test Blade
    public function showSubTest($id){
        $parents = User::leftjoin('wallets',function($join){
            $join ->on('users.id','=','wallets.holder_id');
        })
        ->select('users.*','wallets.balance as wBalance')
        ->orderBy('loginID','asc')
        ->where('created_by',$id)
        ->get();

        return view('admin/subTest', compact('parents'));
    }

    //Show Transactions (Personal)
    public function showTransactions($id){
        $user = User::where('account_id',$id)->first();

        $deposits = DB::table('transactions')
        ->where('meta','like','%deposit%')
        ->get();

        $withdraws = DB::table('transactions')
        ->where('meta','like','%withdraw%')
        ->get();

        $transfers = DB::table('transfers')
        ->join('transactions as deposit','transfers.deposit_id','=','deposit.id')
        ->join('transactions as withdraw','transfers.withdraw_id','=','withdraw.id')
        ->join('users as from','transfers.from_id','=','from.id')
        ->join('users as to','transfers.to_id','=','to.id')
        ->select('transfers.*','deposit.amount as dAmount','withdraw.amount as wAmount','from.loginID as fromName','to.loginID as toName')
        ->get();

        $histories = DB::table('transactions')
        ->join('users as user','transactions.payable_id','=','user.id')
        ->where('user.account_id',$id)
        ->where('meta','like','%Testing%')
        ->get();


        return view('admin/transactionHistory',compact('histories','deposits','withdraws','transfers','user'));
    }

}
