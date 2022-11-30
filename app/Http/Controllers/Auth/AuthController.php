<?php

namespace App\Http\Controllers\Auth;

use DB;
use Cookie;
use Session;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;

// here is the code for settling login,register,logout function
class AuthController extends Controller
{
    //Login
    public function postLogin(Request $request){

        $request->validate([
            'password' => 'required',
            'username' => 'required',
        ]);

        if($request->has('rememberme')){
            Cookie::queue('username',$request->username,1440); //1440 means it stays for 24 hours
            Cookie::queue('password',$request->password,1440);
        }

        $credentials = $request->only('password', 'username');

        if(Auth::attempt($credentials))
        {
            if(Auth::user()->isAdmin()){
                return view('admin/dashboard');
            }
        }

        return view('admin/dashboard');
        //return redirect('login')->with('error', 'Username or password is incorrect. Please try again.');

    }

    //Register
    public function postRegistration(Request $request){
        
        $request->validate([
            'loginID' => 'required',
            'account_id' => 'required',
            'accountLevel' => 'required',
            'password' => 'required',
            'email' => 'required',
            'join_date' => 'required',
            'currency' => 'nullable',
            'credit_limit' => 'required',
            'created_by' => 'required',
        ]);

        // generate account id automatically
        $request['account_id'] = $this->generateAccID(12);

        $data = $request->all();
        $check = $this->create($data);

        if($check){
            $user = User::where('account_id', $request -> account_id)->first();
            if($request -> has('can_deposit')){
                $data = array('user_id' => $request -> account_id,'permission_id' => 1);
                DB::table('user_permissions')->insert($data);
            }
            if($request -> has('can_withdraw')){
                $data = array('user_id' => $request -> account_id,'permission_id' => 2);
                DB::table('user_permissions')->insert($data);
            }
            if($request -> has('can_transfer')){
                $data = array('user_id' => $request -> account_id,'permission_id' => 3);
                DB::table('user_permissions')->insert($data);
            }

            if($user ->hasWallet('default')){
                $wallet = $user -> wallet;
            }
            else if($user -> hasWallet('my-wallet')){
                $wallet = $user -> getWallet('my-wallet');
            }
            else{
                $wallet = $user->createWallet([
                    'name' => 'New Wallet',
                    'slug' => 'my-wallet',
                ]);
            }
        }

        if($request->accountLevel == 2)
        {
            Toastr::success('You successfully register a branch', 'Branch Register', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return back();
        }
        else if($request->accountLevel == 3)
        {
            Toastr::success('You successfully register an agent', 'Agent Register', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return back();
        }
        else if($request->accountLevel == 4)
        {
            Toastr::success('You successfully register a member', 'Member Register', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return back();
        }
        else if($request->accountLevel == sub)
        {
            Toastr::success('You successfully register a sub account', 'Sub Account Register', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return back();
        }
        else
        {
            Toastr::error('Incorrect input. Please try again', 'Error', ["progressBar" => true, "debug" => true, "newestOnTop" =>true, "positionClass" =>"toast-top-right"]);
            return back();
        }
    }

    public function generateAccID($limit)
    {
        $accID = '';
        for($i = 0; $i < $limit; $i++){ $accID .= mt_rand(0, 9); }
        $users = User::all();
        foreach($users as $user){
            if($accID == $user -> account_id){
                generateAccID(12);
            }
            else{
                return $accID;
            }
        }
    }
    
    public function create(array $data){
        
        return User::create([
            'loginID' => $data['loginID'],
            'password' => \Hash::make($data['password']),
            'accountLevel' => $data['accountLevel'],
            'account_id' => $data['account_id'],
            'email' => $data['email'],
            'join_date' => $data['join_date'],
            'currency' => $data['currency'],
            'credit_limit' => $data['credit_limit'],
            'created_by' => $data['created_by'],
        ]);

    }
    
    //Logout
    public function logout(){
        Session::flush();
        Auth::logout();

        return view('login');
    }
}
