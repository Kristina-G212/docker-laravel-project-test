<?php

namespace App\Http\Controllers\Get;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetBookController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request)
  {
    $books = Book::query()
      ->when($request->sortDate, fn($query) => $query->SortByCreationDate($request->sortDate))
      ->when($request->sortPrice, fn($query) => $query->SortByCreationDate($request->sortPrice))
      ->when($request->author, fn($query) => $query->FilterByAuthor($request->author))
      ->when($request->genre, fn($query) => $query->FilterByGenre($request->genre))
      ->when($request->dateBetween, fn($query) => $query->DateBetween($request->from, $request->to));
    $lastBook = Book::orderByDesc('id')->first();
    return BookResource::collection($books->paginate(10))->additional([
      'last_book' => new BookResource($lastBook),
    ]);
  }
}
