<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // public function check(Request $request)
    // {
    //     try {
    //         $credentials = $request->validate([
    //             'email' => ['required', 'email'],
    //             'password' => ['required']
    //         ]);

    //         if (Auth::attempt($credentials)) {
    //             $user = Auth::user();

    //             Auth::login($user, true);
    //             // Session::put("user", $user);
    //             $token = Str::random(60);
    //             return response()->json(['status' => true, 'message' => 'Login successful', 'token' => $token,"user"=>$user]);
    //         }

    //         return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
    //     } catch (\Exception $e) {
    //         Log::error('Login Error: ' . $e->getMessage());
    //         return response()->json(['status' => false, 'message' => 'An error occurred during login. Please try again later.'], 500);
    //     }
    // }
    


    public function check(Request $request)
{
    try {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::once($credentials)) {
            $user = Auth::user();
            $token = Str::random(60);
            auth()->login($user);
            Session::put("user", "hello ooooo testing");

            return response()->json(['status' => true, 'message' => 'Login successful', 'token' => $token, 'user' => $user, "test"=>Session::get("user")]);
        }

        return response()->json(['status' => false, 'message' => 'Invalid credentials'], 401);
    } catch (\Exception $e) {
        Log::error('Login Error: ' . $e->getMessage());
        return response()->json(['status' => false, 'message' => 'An error occurred during login. Please try again later.'], 500);
    }
}


}
