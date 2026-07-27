<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ($request->wantsJson()) {
            if (Auth::attempt($credentials, $request->boolean('remember_me'))) {
                /** @var \App\Models\User $user */
                $user = Auth::user();
                $token = $user->createToken('token')->plainTextToken;
                return response()->json([
                    'user' => new UserResource($user),
                    'token' => $token,
                    'message' => 'success login'
                ], 200);
            };
        };

        // if (Auth::attempt($credentials, $request->boolean('remember_me'))) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/user/profile')->with('success', 'С возвращенеим');
        // };

        if ($request->wantsJson()) {
            return response()->json(['error' => 'Неверные данные'], 401);
        };

        // return back()->withErrors([
        //     'email' => 'Нет такого пользователя',
        // ])->onlyInput('email');
    }
}
