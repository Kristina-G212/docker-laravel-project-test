<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class GetUserCommentsController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $userId = $request->user()->id;
    $comments = Comment::query()->with('user', 'book')->where('user_id', $userId)->paginate(10);

    return CommentResource::collection($comments);
  }
}
