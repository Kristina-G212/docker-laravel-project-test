<?php

namespace App\Builders;

use App\FilterBookClass;
use App\SortBookClass;
use App\SortCommentClass;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomBuilder extends Builder
{

  public function apply(callable $function)
  {
    $function($this);

    return $this;
  }

  public function SearchRequest(Request $request): self
  {
    return $this->apply(new FilterBookClass($request))->apply(new SortBookClass($request))->apply(new SortCommentClass($request));
  }
}
