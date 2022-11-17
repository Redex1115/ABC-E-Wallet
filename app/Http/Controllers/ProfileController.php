<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    //View Profile
    public function view($id){
        $users = User::where('id',$id)->get();

        return view('profile', compact('users'));
    }

}
