<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;
use Override;

class GenreResource extends JsonResource
{
  /**
   * The resource's attributes.
   */
  // public $attributes = [
  //   'name'
  // ];

  // #[Override]
  // public function toArray(Request $request)
  // {
  //   return response()->json([
  //     'genre' => $this->genre,
  //     'message' => 'get book`s genres'
  //   ], 200);
  // }

  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'name' => $this->name,
    ];
  }
}
