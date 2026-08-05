<?php

namespace App\Http\Controllers\FavoriteBook;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Http\Resources\FavoriteBookResource;
use App\Models\Book;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetFavoriteBookController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $user = $request->user();
    $userId = $user->id;
    $favoriteBooks = Favorite::query()->with('user', 'book')->where('user_id', $userId)->paginate(10);

    return FavoriteBookResource::collection($favoriteBooks);
  }
}
