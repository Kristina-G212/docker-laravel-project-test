<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
  /**
   * Show the profile for a given user.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $user = $request->user();

    return response()->json([
      'user' => new UserResource($user)
    ], 200);
  }
}
