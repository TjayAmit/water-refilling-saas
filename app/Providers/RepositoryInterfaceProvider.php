<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\{OrderItemRepositoryInterface,
    OrderRepositoryInterface,
    StationProductRepositoryInterface,
    StationRepositoryInterface,
};

use App\Contracts\Repository\{
    OrderRepository,
    OrderItemRepository,
    StationRepository,
    StationProductRepository
};

class RepositoryInterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(OrderItemRepositoryInterface::class, OrderItemRepository::class);
        $this->app->bind(StationRepositoryInterface::class, StationRepository::class);
        $this->app->bind(StationProductRepositoryInterface::class, StationProductRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
