<?php

namespace App\Http\Controllers ;

use Illuminate\Http\Request;

use App\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class PasswordChangeControl extends Controller
{
    public function index()
    {
    	return view('auth.passwords.passwordcng');
    }

    public function updatepass(Request $req)
    {
    	$password=Auth::user()->password;
    	$oldpassword=$req->oldpass;

    	if (Hash::check($oldpassword, $password)) {
    		$user=User::find(Auth::id());
    		$user->password=Hash::make($req->password);
    		$user->save();
    		Auth::logout();
    		return Redirect()->route('login')->with('successMsg','Successfully Changed Your Password, Now LogIn');
    	}else{
    		return Redirect()->back()->with('errorMsg','Oldpassword does not match !!');
    	}
    }
}
