<?php

namespace App\Strategies;

use App\Interfaces\PinFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryPinFilter implements PinFilterInterface
{
    public function apply(Builder $query, mixed $value): Builder
    {
        return $query->where('category', $value);
    }
}