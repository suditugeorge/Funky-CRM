<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function dashboard()
	{
    	$user = Auth::user();
    	//die(print_r($user));

    	return view('dashboard/profile', ['user' => $user]);
	}
}
