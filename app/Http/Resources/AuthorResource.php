<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;
use Override;

class AuthorResource extends JsonResource
{
  /**
   * The resource's attributes.
   */
  // public $attributes = [
  //   'first_name',
  //   'last_name',
  //   'middle_name',
  //   'nickname'
  // ];

  #[Override]
  public function toArray(Request $request)
  {
    return [

      'first_name' => $this->first_name,
      'last_name' => $this->last_name,
      'middle_name' => $this->middle_name,
      'nickname' => $this->nickname

      // 'meta' => [
      //   'total_authors' => $this->total(),
      //   'per_page' => $this->perPage(),
      //   'current_page' => $this->currentPage(),
      //   'last_page' => $this->lastPage(),
      // ],
      // 'links' => [
      //   'first' => $this->url(1),
      //   'last' => $this->url($this->lastPage()),
      //   'prev' => $this->previousPageUrl(),
      //   'next' => $this->nextPageUrl(),
      // ],
    ];
  }
}
