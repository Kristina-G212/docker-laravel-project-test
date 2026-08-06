<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

class AuthorResource extends JsonResource
{
  /**
   * The resource's attributes.
   */

  #[Override]
  public function toArray(Request $request)
  {
    return [
      'id' => $this->id,
      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'middle_name' => $this->middle_name,
      'nickname' => $this->nickname,
      'media' => $this->getMedia('author-photo')->map(fn($media) => [
        'url' => $media->getUrl(),
        'path' => $media->getPath()
      ]),
    ];
  }
}
