<?php

namespace App\Http\Controllers\FavoriteBook;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class DeleteOneFavoriteBookController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $userId = $request->user()->id;
    $bookId = $request->input('book_id');

    if (Favorite::query()->where('user_id', $userId)->where('book_id', $bookId)->doesntExist()) {
      return response()->json([
        'message' => 'you dont have this book to delete it'
      ], 200);
    }

    if (Favorite::query()->where('user_id', $userId)->where('book_id', $bookId)->exists()) {
      Favorite::query()->where('user_id', $userId)->where('book_id', $bookId)->delete();
      return response()->json([
        'message' => 'favotite book deleted'
      ], 200);
    }

    // Favorite::upsert(['user_id' => $userId,  'book_id' => $bookId], ['user_id', 'book_id']);

    return response()->json([
      'message' => 'unluck to delete the favotite book'
    ], 200);
  }
}
