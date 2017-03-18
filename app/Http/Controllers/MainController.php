<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
	public function login()
	{
		/*
    	$has_root = User::where('username', '=', 'root-dorminator')->first();
    	
    	if(is_null($has_root)){
    		self::initializeRoot();
    	}

        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        */

    	return view('login');
	}
}
