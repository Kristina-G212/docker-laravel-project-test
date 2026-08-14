<?php

namespace App\Http\Controllers\Get;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class GetBookController extends Controller
{
  /**
   * Handle the incoming request.
   */
  
  public function __invoke(Request $request)
  {
    $book_id = $request->input('id');
    
    $books = Book::query()->SearchRequest($request)->when($book_id, function (Builder $query) use ($book_id) {
      $query->where('id', $book_id);
    })->paginate(10);

    $lastBook = Book::orderByDesc('id')->first();

    return BookResource::collection($books)->additional([
      'last_book' => new BookResource($lastBook)
    ]);
  }
}
