<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Mail;

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

    public function addFunkyUser(Request $request)
    {
        if($request->isMethod('get')){
            return view('dashboard/add-funky',['user' => Auth::user()]);
        }

        $request->emails = preg_split('`\s`', $request->emails);
        foreach ($request->emails as $email) {

            $user = new User();
            $user->name = "Utilizator Funky";
            $user->email = $email;
            $password = str_random(8);
            $user->password = Hash::make($password);
            $user->is_admin = 0;
            $user->save();

            $data = ['email' => $email,'password' => $password];

            Mail::send('email-templates.add-admin', $data, function ($m) use ($email) {
                $m->from('i.tconsult99@gmail.com', 'Funcky-Catalog');
                $m->to($email)->subject('Funky-Catalog are nevoie de atenția ta!');
            });
        }
        return response()->json(['success'=>true,'message' => 'Utilizatorii au fost adăugați']);
    
    }

}
