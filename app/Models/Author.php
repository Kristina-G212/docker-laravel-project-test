<?php

namespace App\Models;

use Database\Factories\AuthorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UseFactory(AuthorFactory::class)]
#[Fillable(['first_name', 'last_name', 'middle_name', 'nickname'])]
class Author extends Model
{
  use HasFactory;
  /**
   * Get the author for the book.
   */
  public function books(): HasMany
  {
    return $this->hasMany(Book::class);
  }
}
