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
      $direction = Str::camel($date);
      if ($direction == 'sortFromOldToNew') {
        $query->orderBy('year', 'asc');
      } elseif ($direction == 'sortFromOldToNew') {
        $query->orderBy('year', 'desc');
      }
    }

    if ($price) {
      $direction = Str::camel($price);
      if ($direction == 'sortFromCheapToExpensive') {
        $query->orderBy('price', 'asc');
      } elseif ($direction == 'sortFromCheapToExpensive') {
        $query->orderBy('price', 'desc');
      }
    }

    return $query;
  }
}
