<?php

namespace App\Services;

use App\Interfaces\Repositories\PinRepositoryInterface;
use App\Models\Pin;
use App\Models\User;

class PinService
{
    public function __construct(private PinRepositoryInterface $pins)
    {
    }

    public function detail(Pin $pin): Pin
    {
        return $this->pins->findWithRelations($pin->id);
    }

    public function create(User $user, array $data): Pin
    {
        return $this->pins->create(array_merge($data, ['user_id' => $user->id]));
    }

    public function update(Pin $pin, array $data): Pin
    {
        return $this->pins->update($pin, $data);
    }
    

    public function delete(Pin $pin): bool
    {
        return $this->pins->delete($pin);
    }
}