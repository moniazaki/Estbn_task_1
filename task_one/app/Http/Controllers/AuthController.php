<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'birthday' => 'required|date',
            'gender' => 'required|in:male,female',
        ]);
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'birthday' => $validated['birthday'],
            'gender' => $validated['gender'],
            'role'=> 'operator',
        ]);
        return response()->json([
            'success' => 'User registered successfully',
            'user' => $user
        ],200);
    }

    public function login(Request $request){

        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if(Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])){
            $user = Auth::user();
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => 'User logged in successfully',
                'user' =>$user,
                'token' => $token
            ],200);
        }

        return response()->json([
            'message' =>'Invalid credentials'
        ],401);
    }
}
