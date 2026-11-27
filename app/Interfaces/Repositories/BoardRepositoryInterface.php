<?php

namespace App\Interfaces\Repositories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Collection;

interface BoardRepositoryInterface extends BaseRepositoryInterface
{
    public function getByUser(int $userId): Collection;
    public function findWithPins(int $id): ?Board;
}