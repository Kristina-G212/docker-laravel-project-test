<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class TwoFactorController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email'],
      'code' => ['required', 'integer'],
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || $user->two_factor_code !== $request->code) {
      return response()->json([
        'error' => 'invalid code'
      ], 422);
    }

    if ($user->two_factor_expires_at->lt(now())) {
      $user->resetTwoFactorCode();
      return response()->json([
        'error' => 'code has expired. login again'
      ], 422);
    }

    $user->resetTwoFactorCode();
    $token = $user->createToken('token')->plainTextToken;

    return response()->json([
      'user' => new UserResource($user),
      'token' => $token,
      'message' => 'success login'
    ], 200);
  }
}
