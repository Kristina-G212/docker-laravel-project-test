<?php

namespace App\Http\Controllers\Get;

use App\Http\Controllers\Controller;
use App\Http\Resources\Collection\GenreCollection;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetBookGenreController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke(Request $request): JsonResponse
  {
    $genres = Genre::all();

    return response()->json([
      'count' => $genres->count(),
      'genre' => GenreResource::collection($genres),
      'message' => 'get book`s genre',
    ], 200);
  }
}
