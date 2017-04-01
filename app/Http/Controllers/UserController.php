<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
	public function dashboard()
	{
    	$user = Auth::user();
    	//die(print_r($user));

    	return view('dashboard/profile', ['user' => $user]);
	}

    public static function getBasicInfo()
    {
        $user = Auth::user();

		$basic_info = "Acest cont este deținut de un Admin";

        return $basic_info;
    }

    public function changeProfilePhoto(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('profilePicture');

        if(!$file){
            return view('dashboard/profile', ['user' => $user, 'error_message' => "Există o problemă cu fișierul încarcat"]);
        }

        $rules = [
            'file' => 'required | mimes:jpeg,jpg,png ',
        ];
        $validator = Validator::make(['file' => $file], $rules);
        if (!$validator->fails()) {
            $file_name = $user->id . '.jpg';
            Storage::disk('user-profiles')->put($file_name, File::get($file));
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('dashboard');
        }
    }

    public function updateProfile(Request $request)
    {
        try{
            $user = Auth::user();

            $user->name = $request['name'];
            $user->update();
        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
            ]);               
        }
        return response()->json([
            'success' => true,
        ]); 
    }

    public function searchUsers(Request $request)
    {
        return view('dashboard/users',['user' => Auth::user()]);
    }

}
