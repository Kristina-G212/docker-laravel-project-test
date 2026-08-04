<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * Настроить фильтры для метода получения книг
 *  Фильтр по автору
 *  Фильтр по жанру
 *  Фильтр по году издания от до
 */
class FilterBookClass
{
  public function __construct(protected readonly Request $request) {}

  public function __invoke(Builder $query): Builder
  {
    $author = $this->request->query('author');
    $genre = $this->request->query('genre');
    $from = $this->request->query('from');
    $to = $this->request->query('to');

    if ($author) {
      return $query->whereHas("author", function ($query) use ($author) {
        $query->where('first_name', 'ilike', "%$author%");
      });
    }

    if ($genre) {
      return $query->whereHas("genre", function ($query) use ($genre) {
        $query->where('name', 'ilike', "%$genre%");
      });
    }

    if ($from && $to) {
      return $query->whereBetween('year', [$from, $to]);
    } elseif ($from) {
      return $query->whereBetween('year', ">= $from");
    } elseif ($to) {
      return $query->whereBetween('year', "<= $from");
    }

    return $query;
  }
}
