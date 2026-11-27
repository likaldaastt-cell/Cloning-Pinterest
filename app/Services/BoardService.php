<?php

namespace App\Services;

use App\Interfaces\Repositories\BoardRepositoryInterface;
use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class BoardService
{
    public function __construct(private BoardRepositoryInterface $boards)
    {
    }

    public function listForUser(User $user): Collection
    {
        return $this->boards->getByUser($user->id);
    }

    public function getWithPins(Board $board): Board
    {
        return $this->boards->findWithPins($board->id);
    }

    public function create(User $user, array $data): Board
    {
        return $this->boards->create(array_merge($data, ['user_id' => $user->id]));
    }

    public function update(Board $board, array $data): Board
    {
        return $this->boards->update($board, $data);
    }

    public function delete(Board $board): bool
    {
        return $this->boards->delete($board);
    }
}