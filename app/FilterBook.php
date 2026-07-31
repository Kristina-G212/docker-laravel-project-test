<?php

namespace App;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class SortBook extends Builder
{
  /**
   * Create a new class instance.
   * 
   * Настроить фильтры для метода получения книг
   *  Фильтр по автору
   *  Фильтр по жанру
   *  Фильтр по году издания от до

   */
  public function __construct(Request $request) {
      
  }
}
