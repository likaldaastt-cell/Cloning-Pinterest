<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface PinFilterInterface
{
    public function apply(Builder $query, mixed $value): Builder;
}