<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SortCommentClass
{
  /**
   * Create a new class instance.
   */
  public function __construct(private Request $request)
  {
    $this->request = $request;
  }

  /**
   * Invoke the class instance.
   */
  public function __invoke(Builder $query): Builder
  {
    $date = $this->request->query('sortDateComment');
    $rating = $this->request->query('sortRating');

    if ($date) {
      $direction = Str::camel($date);
      if ($direction == 'sortFromOldToNew') {
        $query->orderBy('created_at', 'asc');
      } elseif ($direction == 'sortFromNewToOld') {
        $query->orderBy('created_at', 'desc');
      }
    }

    if ($rating) {
      $direction = Str::camel($rating);
      if ($direction == 'sortFromBadToGood' ) {
        $query->orderBy('rating', 'asc');
      } elseif ($direction == 'sortFromGoodToBad') {
        $query->orderBy('rating', 'desc');
      }
    }

    return $query;
  }
}
