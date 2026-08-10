<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddCommentController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $userId = $request->user()->id;

    $validated = $request->validate([
      'book_id' => ['required', 'integer'],
      'rating' => ['required', 'integer', 'min:1', 'max:5'],
      'description' => ['string'],
      'plus' => ['string'],
      'minus' => ['string'],
      'anonymous' => ['required', 'boolean', 'min:0', 'max:1'],
    ]);

    if (Comment::query()->where('user_id', $userId)->where('book_id', $validated['book_id'])->exists()) {
      return response()->json([
        'message' => 'you already commented this book'
      ], 200);
    }

    if (Comment::query()->where('user_id', $userId)->where('book_id', $validated['book_id'])->doesntExist()) {
      Comment::insert([
        'user_id' => $userId,
        'book_id' => $validated['book_id'],
        'rating' => $validated['rating'],
        'description' => $validated['description'],
        'plus' => $validated['plus'],
        'minus' => $validated['minus'],
        'anonymous' => $validated['anonymous'],
      ]);

      return response()->json([
        'message' => 'book commented'
      ], 200);
    }

    return response()->json([
      'message' => 'unluck to comment the book'
    ], 200);
  }
}
