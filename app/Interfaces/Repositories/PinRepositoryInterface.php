<?php

namespace App\Interfaces\Repositories;

use App\Models\Pin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface PinRepositoryInterface extends BaseRepositoryInterface
{
    public function feedQuery(?int $viewerId = null): Builder;
    public function getByUser(int $userId): Collection;
    public function findWithRelations(int $id): ?Pin;
}