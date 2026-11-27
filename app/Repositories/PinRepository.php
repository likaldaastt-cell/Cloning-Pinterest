<?php

namespace App\Repositories;

use App\Interfaces\Repositories\PinRepositoryInterface;
use App\Models\Pin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PinRepository extends BaseRepository implements PinRepositoryInterface
{
    public function __construct(Pin $model)
    {
        parent::__construct($model);
    }

    public function feedQuery(?int $viewerId = null): Builder
    {
        return $this->model->newQuery()
            ->with('user')
            ->withCount('likedBy')
            ->withExists(['likedBy as liked_by_me' => fn ($q) => $q->where('users.id', $viewerId)])
            ->latest();
    }

    public function getByUser(int $userId): Collection
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->with('user')
            ->withCount('likedBy')
            ->latest()
            ->get();
    }

    public function findWithRelations(int $id): ?Pin
    {
        return $this->model->newQuery()
            ->with(['user', 'board'])
            ->withCount('likedBy')
            ->find($id);
    }
}