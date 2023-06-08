<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // return "hello";
            // $user = Auth::user();
            $user = Session::get("user");
            return json_encode(["user"=>$user, "message"=> "hello"]);
            // if ($user) {
            //     return response()->json(['user' => $user]);
            // } else {
            //     return response()->json(['message' => 'User not found'], 404);
            // }

        }
}
