<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Contracts\{
    NotificationRepositoryInterface,
    OrderItemRepositoryInterface,
    OrderRepositoryInterface,
    StationProductRepositoryInterface,
    StationRepositoryInterface
};

use App\Contracts\Repository\{
    NotificationRepository,
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
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
