<?php

namespace App\Http\Controllers\FavoriteBook;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddFavoriteBookController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $userId = $request->user()->id;
    $bookId = $request->input('book_id');

    if (Favorite::query()->where('user_id', $userId)->where('book_id', $bookId)->exists()) {
      return response()->json([
        'message' => 'book already added to favotite'
      ], 200);
    }

    if (Favorite::query()->where('user_id', $userId)->where('book_id', $bookId)->doesntExist()) {
      Favorite::insert([
        'user_id' => $userId,
        'book_id' => $bookId
      ]);
      return response()->json([
        'message' => 'book added to favotite'
      ], 200);
    }

    // Favorite::upsert(['user_id' => $userId,  'book_id' => $bookId], ['user_id', 'book_id']);
    
    return response()->json([
      'message' => 'unluck to add the book to favotite'
    ], 200);
  }
}
