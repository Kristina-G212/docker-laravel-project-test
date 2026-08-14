<?php

namespace App\Models;

use App\Builders\CustomBuilder;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[UseFactory(CommentFactory::class)]
#[Fillable('user_id', 'book_id', 'rating', 'description', 'plus', 'minus', 'anonymous')]
class Comment extends Model
{
  /** @use HasFactory<\Database\Factories\CommentFactory> */
  use HasFactory;

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function book(): BelongsTo
  {
    return $this->BelongsTo(Book::class);
  }

  public function newEloquentBuilder($query): CustomBuilder
  {
    return new CustomBuilder($query);
  }
}
