<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'nickname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the user
        $user = User::create([
            'nickname' => $validated['nickname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Get verification
        event(new Registered($user));
        
        // Log them in
        Auth::login($user);

        $token = $user->createToken('token')->plainTextToken;

        $res = [
            'user' => $user,
            'token' => $token,
        ];

        if ($request->wantsJson()) { 
            return response()->json([
                'user' => new UserResource($user),
                'token' => $token,
                'message' => 'registered'
            ]);
        };

        // Redirect to home
        return redirect()->route('profile')->with('success', 'Добро пожаловать');
    }
}