<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswordController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $user = $request->user();

    // Validate the input
    $validated = $request->validate([
      'current_password' => 'required|string|min:8',
      'password' => 'required|string|min:8|confirmed',
    ]);

    if (Hash::check($validated['current_password'], $user->password)) {
      $user->update([
        'password' => Hash::make($validated['password']),
      ]);
      return response()->json([
        'message' => 'success password change'
      ], 200);
    } else {
      return response()->json([
        'error' => 'unluck to change password'
      ], 422);
    }
  }
}
