<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            $has_root = User::where('email', '=', 'root@funkycitizens.org')->first();

            if (is_null($has_root)) {
                self::initializeRoot();
            }

            if (Auth::check()) {
                return redirect()->route('dashboard');
            }

            return view('login');
        } elseif ($request->isMethod('post')) {
            try {
                $email = $request['email'];
                $password = $request['password'];
                $remember = $request['remember'];

                $user = User::where('email', '=', $email)->first();

                if ($user === null) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Aceast utilizator nu există.',
                        'field' => 'email',
                    ]);
                } elseif (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
                    return response()->json([
                        'success' => true,
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Parola este greșită',
                        'field' => 'password',
                    ]);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'A intervenit o problemă! Vă rugăm să ne contactați telefonic.',
                ]);
            }
        }

    }

    public function initializeRoot()
    {
        try {
            $user = new User();
            $user->name = "Admin";
            $user->email = "admin@funkycitizens.org";
            $user->password = Hash::make("admin");
            $user->is_admin = true;
            $user->save();

        } catch (\Exception $e) {

        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
