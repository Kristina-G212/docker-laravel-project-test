<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;
use Override;

class BookResource extends JsonResource
{
  /**
   * The resource's attributes.
   */
  // public $attributes = [
  //   'title',
  //   'description',
  //   'price',
  //   'old_price',
  //   'year'
  // ];

  // /**
  //  * The resource's relationships.
  //  */

  // #[Override]
  // public function toRelationships(Request $request)
  // {
  //   return [
  //     'author' => AuthorResource::class,
  //     'genre' => GenreResource::class,
  //   ];
  // }

  #[Override]
  public function toArray(Request $request)
  {
    return [
      'title' => $this->title,
      'description' => $this->description,
      'price' => $this->price,
      'old_price' => $this->old_price,
      'year' => $this->year,
      'genre' => new GenreResource($this->genre),
      'author' => new AuthorResource($this->author),
    ];
  }
}
