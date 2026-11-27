<?php

namespace App\Services;

use App\Interfaces\Repositories\PinRepositoryInterface;
use App\Models\User;

class ProfileService
{
    public function __construct(private PinRepositoryInterface $pins)
    {
    }

    public function getProfileData(User $user): array
    {
        return [
            'user' => $user->loadCount(['boards', 'pins']),
            'pins' => $this->pins->getByUser($user->id),
        ];
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user->refresh();
    }
}