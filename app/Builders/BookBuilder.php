<?php

namespace App\Builders;

use Illuminate\Database\Eloquent\Builder;

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
// --------------------------------------------------
  public function FilterByAuthor(string $author)
  {
    return $this->whereHas("author", function ($query) use ($author) {
      $query->where('first_name', 'ilike', "%$author%");
    });
  }

  public function FilterByGenre(string $genre)
  {
    return $this->whereHas("genre", function ($query) use ($genre) {
      $query->where('name', 'ilike', "%$genre%");
    });
  }

  public function DateBetween(int $from, int $to) {
    return $this->whereBetween('year', [$from, $to]);
  }
}
