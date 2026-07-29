<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
  /**
   * Log the user out of the application.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $user = $request->user();

    if ($user) {
      $user->tokens()->delete();
    }

    return response()->json([
      'message' => 'success logout'
    ], 200);
  }
}
