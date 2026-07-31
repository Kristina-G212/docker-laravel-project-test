<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**

 * Настроить сортировки для метода получения книг
 * Сортировка по дате создания
 *  От старых к новым
 *  От новых к старым
 * Сортировка по цене
 *  От дешевых к дорогим
 *  От дорогих к дешевым
 */
class BookBuilder extends Builder
{
  public function SortByCreationDate(string $date)
  {
    if ($date == 'SortFromOldToNew') {
      return $this->orderBy('year', 'asc');
    } elseif ($date == 'SortFromNewToOld') {
      return $this->orderBy('year', 'desc');
    }
    return $this;
  }

  public function SortByPrice(string $price)
  {
    if ($price  == 'SortFromCheapToExpensive') {
      return $this->orderBy('price', 'asc');
    } elseif ($price == 'SortFromExpensiveToCheap') {
      return $this->orderBy('price', 'desc');
    }
    return $this;
  }
}
