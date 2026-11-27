<?php

namespace App\Strategies;

use App\Interfaces\PinFilterInterface;
use Illuminate\Database\Eloquent\Builder;

class UserPinFilter implements PinFilterInterface
{
    public function apply(Builder $query, mixed $value): Builder
    {
        return $query->where('user_id', (int) $value);
    }
}