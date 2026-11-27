<?php

namespace App\Services;

use App\Interfaces\PinFilterInterface;
use App\Interfaces\Repositories\PinRepositoryInterface;
use App\Strategies\CategoryPinFilter;
use App\Strategies\UserPinFilter;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FeedService
{
    /** @var array<string, PinFilterInterface> */
    private array $filters;

    public function __construct(private PinRepositoryInterface $pins)
    {
        // Menambah filter baru = membuat class baru + menambah satu baris di sini.
        // Logika getFeed() di bawah tidak perlu diubah (OCP).
        $this->filters = [
            'category' => new CategoryPinFilter(),
            'user' => new UserPinFilter(),
        ];
    }

    public function getFeed(array $params, ?int $viewerId = null, int $perPage = 20): LengthAwarePaginator
    {
        $query = $this->pins->feedQuery($viewerId);

        foreach ($this->filters as $key => $filter) {
            if (filled($params[$key] ?? null)) {
                // polymorphism: dipanggil lewat kontrak yang sama
                $query = $filter->apply($query, $params[$key]);
            }
        }

        return $query->paginate($perPage)->withQueryString();
    }
}