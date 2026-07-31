<?php

namespace App;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class SortBook extends Builder
{
  /**
   * Create a new class instance.
   * 
   * Настроить сортировки для метода получения книг
   * Сортировка по дате создания
   *  От старых к новым
   *  От новых к старым
   * Сортировка по цене
   *  От дешевых к дорогим
   *  От дорогих к дешевым
   */
  public function __construct(Request $request)
  {
    
  }
}
