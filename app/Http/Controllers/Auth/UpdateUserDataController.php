<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateUserDataController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $user = $request->user();
    $updateData = $request->only(['phone', 'email', 'first_name', 'last_name', 'middle_name', 'nickname']);
    $filtredData = array_filter($updateData, function ($value) {
      if (is_null($value) || $value == '') {
        return;
      } else {
        return $value;
      }
    });
    $user->update($filtredData);

    return response()->json([
      'user' => new UserResource($user),
      'message' => 'success update',
    ], 200);
  }
}
