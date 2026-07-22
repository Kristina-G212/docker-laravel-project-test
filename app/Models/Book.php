<?php

namespace App\Models;

use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
     * $table->foreignId('genre_id');
     * $table->foreignId('author_id');
*/

#[UseFactory(BookFactory::class)]
#[Fillable('genre_id', 'author_id', 'title', 'description', 'price', 'old_price', 'year')]
class Book extends Model
{
    use HasFactory;
    /**
     * Get the genre that owns the book.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class)->chaperone(); // chaperone() по всей видимости (по докам) автоматически подгрузит модели Жанров, чтобы не упасть в ошибку
    } 
    /**
     * Get the author that owns the book.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class)->chaperone();
    } 
}
