<?php
namespace App\Providers;
use App\Interfaces\Repositories\BoardRepositoryInterface;
use App\Interfaces\Repositories\PinRepositoryInterface;
use App\Repositories\BoardRepository;
use App\Repositories\PinRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BoardRepositoryInterface::class, BoardRepository::class);
        $this->app->bind(PinRepositoryInterface::class, PinRepository::class);
    }
}