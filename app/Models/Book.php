<?php

namespace App\Models;

use App\Builders\CustomBuilder;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Override;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

use function Termwind\terminal;

/**
 * $table->foreignId('genre_id');
 * $table->foreignId('author_id');
 */

#[UseFactory(BookFactory::class)]
#[Fillable('genre_id', 'author_id', 'title', 'description', 'price', 'old_price', 'year')]
class Book extends Model implements HasMedia
{
  use HasFactory, InteractsWithMedia;
  /**
   * Get the genre that owns the book.
   */
  public function genre(): BelongsTo
  {
    return $this->belongsTo(Genre::class); // chaperone() по всей видимости (по докам) автоматически подгрузит модели Жанров, чтобы не упасть в ошибку
  }
  /**
   * Get the author that owns the book.
   */
  public function author(): BelongsTo
  {
    return $this->belongsTo(Author::class); //->chaperone(); работает только с hasmany
  }

  /**
   * пользователи, принадлежащие к книге
   */
  public function favorite(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'favorites', 'book_id', 'user_id');
  }

  public function registerMediaCollections(?Media $media = null): void
  {
    $this->addMediaCollection('book-picture');
  }

  public function registerMediaConversions(?Media $media = null): void
  {
    $this
      ->addMediaConversion('preview')
      ->fit(Fit::Contain, 300, 300)
      ->nonQueued();
  }

  public function newEloquentBuilder($query): CustomBuilder
  {
    return new CustomBuilder($query);
  }
}
