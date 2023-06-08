<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class RegisterUserController extends Controller
{
    public function store(Request $request)
{
    try {
        $data = $request->validate([
            'username' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6'],
            'isArtist' => ['required', 'boolean'],
            'phone' => ['required', 'string', 'unique:users,phone'],
        ], [
            'username.required' => 'Please provide a username.',
            'email.required' => 'Please provide an email address.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email address is already registered.',
            'password.required' => 'Please provide a password.',
            'password.min' => 'The password must be at least 6 characters.',

            'phone.required' => 'Please provide a phone number.',
            'phone.unique' => 'This phone number is already registered.',
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json(['status' => true, 'message' => 'Registration successful']);
    } catch (\Illuminate\Validation\ValidationException $e) {
        $errors = $e->errors();
        $errorMessages = [];

        foreach ($errors as $field => $error) {
            $errorMessages[$field] = $error[0];
        }

        return response()->json(['status' => false, 'errors' => $errorMessages], 422);
    } catch (\Exception $e) {
        Log::error('Error: ' . $e->getMessage());
        return response()->json(['status' => false, 'message' => 'An unexpected error occurred.'], 500);
    }
}
}
