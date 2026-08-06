<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;
use Override;

class BookResource extends JsonResource
{
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
      'media' => $this->getMedia('book-picture')->map(function ($media) {
        return [
          'url' => $media->getUrl(),
          'path' => $media->getPath()
          ];
      }),
      'preview' => $this->getFirstMediaUrl('preview'),
      ];
  }
}
