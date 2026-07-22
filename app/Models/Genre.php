<?php

namespace App\Models;

use Database\Factories\GenreFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UseFactory(GenreFactory::class)]
#[Fillable('name')]
class Genre extends Model
{
    use HasFactory;
    /**
     * Get the genre for the book. 
     */
    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
