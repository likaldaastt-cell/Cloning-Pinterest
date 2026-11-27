<?php

namespace App\Repositories;

use App\Interfaces\Repositories\BoardRepositoryInterface;
use App\Models\Board;
use Illuminate\Database\Eloquent\Collection;

class BoardRepository extends BaseRepository implements BoardRepositoryInterface
{
    public function __construct(Board $model)
    {
        parent::__construct($model);
    }

    public function getByUser(int $userId): Collection
    {
        return $this->model->newQuery()
            ->where('user_id', $userId)
            ->withCount('pins')
            ->latest()
            ->get();
    }

    public function findWithPins(int $id): ?Board
    {
        return $this->model->newQuery()
            ->with(['user', 'pins' => fn ($q) => $q->with('user')->withCount('likedBy')->latest()])
            ->find($id);
    }
}