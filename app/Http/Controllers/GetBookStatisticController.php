<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetBookStatisticController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $bookId = $request->input('book_id');
    $avgRating = round(Comment::query()->where('book_id', $bookId)->avg('rating'), 1);
    $commentCount = Comment::query()->where('book_id', $bookId)->count();
    $rating1 = Comment::query()->where('book_id', $bookId)->where('rating', '1')->count();
    $rating2 = Comment::query()->where('book_id', $bookId)->where('rating', '2')->count();
    $rating3 = Comment::query()->where('book_id', $bookId)->where('rating', '3')->count();
    $rating4 = Comment::query()->where('book_id', $bookId)->where('rating', '4')->count();
    $rating5 = Comment::query()->where('book_id', $bookId)->where('rating', '5')->count();

    return response()->json([
      'average_rating' => $avgRating,
      'comment_count' => $commentCount,
      'rating_1' => $rating1,
      'rating_2' => $rating2,
      'rating_3' => $rating3,
      'rating_4' => $rating4,
      'rating_5' => $rating5,
      'message' => 'book statistic'
    ], 200);
  }
}
