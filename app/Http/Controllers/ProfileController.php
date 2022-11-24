<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    //View Profile
    public function view(){
        $users = User::where('id',Auth::user()->id)->first();

        return view('profile', compact('users'));
    }

}
