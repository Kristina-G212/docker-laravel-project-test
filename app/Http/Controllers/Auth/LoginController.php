<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Middleware\TwoFactor;
use App\Http\Resources\UserResource;
use App\Notifications\TwoFactorCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  /**
   * Handle an authentication attempt.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials)) {
      return response()->json(['error' => 'Неверные данные'], 401);
    }
    /** @var \App\Models\User $user */
    $user = \App\Models\User::where('email', $request->email)->first();
    $user->generateTwoFactorCode();
    $user->notify(new TwoFactorCode());

    return response()->json([
      '2fa_code_required' => true,
      'message' => '2fa code send to your email'
    ], 200);
  }
}
