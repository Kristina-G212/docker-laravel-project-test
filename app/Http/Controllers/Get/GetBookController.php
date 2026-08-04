<?php

namespace App\Http\Controllers\Get;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class GetBookController extends Controller
{
  /**
   * Handle the incoming request.
   */
  
  public function __invoke(Request $request)
  {
    $books = Book::query()->SearchRequest($request)->paginate(10);

    $lastBook = Book::orderByDesc('id')->first();

    return BookResource::collection($books)->additional([
      'last_book' => new BookResource($lastBook)
    ]);
  }
}
