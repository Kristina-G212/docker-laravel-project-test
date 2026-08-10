<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class UpdatetUserCommentController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $userId = $request->user()->id;
    $bookId = $request->input('book_id');

    $validated = $request->validate([
      'rating' => ['sometimes', 'integer', 'min:1', 'max:5', 'nullable'],
      'description' => ['sometimes', 'string', 'nullable'],
      'plus' => ['sometimes', 'string', 'nullable'],
      'minus' => ['sometimes', 'string', 'nullable'],
      'anonymous' => ['sometimes', 'boolean', 'nullable'],
    ]);

    $filtredData = array_filter($request->only($validated['rating'], $validated['description'], $validated['plus'], $validated['minus']), function ($value) {
      if (is_null($value) || $value == "") {
        return;
      } else {
        return $value;
      }
    });

    Comment::query()->with('user', 'book')->where('user_id', $userId)->where('book_id', $bookId)->update($filtredData);

    if (!is_null($validated['anonymous'])) {
      Comment::query()->with('user', 'book')->where('user_id', $userId)->where('book_id', $bookId)->update(['anonymous' => $validated['anonymous']]);
    }

    $comment = Comment::query()->with('user', 'book')->where('user_id', $userId)->where('book_id', $bookId)->first();

    return response()->json([
      'book_id' => $bookId,
      'comment' => new CommentResource($comment),
      'message' => 'seccess update comment'
    ], 200);
  }
}
