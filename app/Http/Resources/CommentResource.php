<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'user_nickname' => $this->anonymous == 0 ? $this->whenLoaded('user', function () {
        return $this->user->nickname;
      }) : 'anonymous',
      'rating' => $this->rating,
      'description' => $this->description,
      'plus' => $this->plus,
      'minus' => $this->minus,
      'anonymous' => $this->anonymous,
      'created_at' => $this->created_at
    ];
  }
}
