<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmailViews extends Controller
{
    public function addFunkyUser(Request $request)
    {

    	$password = str_random(8);
    	$email = $request->email;
    	$data = ['email' => $email,'password' => $password];
    	return view('email-templates.add-admin',$data);
    }
}
