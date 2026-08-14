<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Http\Resources\CommentResource;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\Request;

class GetCommentsController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $bookId = $request->input('book_id');
    $book = Book::query()->where('id', $bookId)->first();
    $comments = Comment::query()->with('user', 'book')->SearchRequest($request)->where('book_id', $bookId)->paginate(10);

    return CommentResource::collection($comments)->additional([
      'message' => 'get all comments for current book', 
      'book' => new BookResource($book),
    ]);
  }
}
