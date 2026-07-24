<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     */
    public function __invoke(Request $request): RedirectResponse | JsonResponse | UserResource
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember_me'))) {
            $request->session()->regenerate();
            
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            
            if ($request->wantsJson()) {
                return response()->json([
                    'user' => new UserResource($user),
                    'token' => $token,
                    'message' => 'success login'
                ], 200);
            };
            return redirect()->intended('/user/profile')->with('success', 'С возвращенеим');
        }
        // if (Auth::viaRemember())

        if ($request->wantsJson()) {
            return response()->json(['error' => 'Неверные данные'], 401);
        };

        return back()->withErrors([
            'email' => 'Нет такого пользователя',
        ])->onlyInput('email');
    }
}
