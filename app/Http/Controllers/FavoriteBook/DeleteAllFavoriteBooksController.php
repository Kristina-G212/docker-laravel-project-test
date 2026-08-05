<?php

namespace App\Http\Controllers\FavoriteBook;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class DeleteAllFavoriteBooksController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $userId = $request->user()->id;

    if (Favorite::query()->where('user_id', $userId)->doesntExist()) {
      return response()->json([
        'message' => 'you dont have any book to delete'
      ], 200);
    }

    if (Favorite::query()->where('user_id', $userId)->exists()) {
      Favorite::query()->where('user_id', $userId)->delete();
      return response()->json([
        'message' => 'favotite books deleted'
      ], 200);
    }
    
    return response()->json([
      'message' => 'unluck to delete favotite books'
    ], 200);
  }
}
