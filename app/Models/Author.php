<?php

namespace App\Models;

use Database\Factories\AuthorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Override;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

#[UseFactory(AuthorFactory::class)]
#[Fillable(['first_name', 'last_name', 'middle_name', 'nickname'])]
class Author extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;
  /**
   * Get the author for the book.
   */
  public function books(): HasMany
  {
    return $this->hasMany(Book::class);
  }

  #[Override]
  public function registerMediaCollections(?Media $media = null): void
  {
    $this
      ->addMediaCollection('author-photo')
      ->singleFile();
  }
}
