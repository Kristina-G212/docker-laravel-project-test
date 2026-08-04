<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Настроить сортировки для метода получения книг
 * Сортировка по дате создания
 *  От старых к новым
 *  От новых к старым
 * Сортировка по цене
 *  От дешевых к дорогим
 *  От дорогих к дешевым
 */
class SortBookClass
{
  public function __construct(protected readonly Request $request) {}

  public function __invoke(Builder $query): Builder
  {
    $date = $this->request->query('sortDate');
    $price = $this->request->query('sortPrice');

    if ($date) {
      $direction = Str::camel($date) === 'sortFromOldToNew' ? 'asc' : 'desc';
      return $query->orderBy('year', $direction);
    }

    if ($price) {
      $direction = Str::camel($price) === 'sortFromCheapToExpensive' ? 'asc' : 'desc';
      return $query->orderBy('year', $price);
    }

    return $query;
  }
}
