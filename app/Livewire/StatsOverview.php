<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Station;
use App\Models\Order;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalStations = Station::count();
        $stationsIncrease = Station::whereDate('created_at', today())->count();
        $overduePlanToPay = Order::where('status', 'overdue')->count();
        $ordersToday = Order::whereDate('created_at', today())->count();

        return [
            Stat::make('Total Stations', $totalStations)
                ->description($stationsIncrease . ' increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
            Stat::make('Overdue Plan to Pay', $overduePlanToPay)
                ->description('Total overdue')
                ->descriptionIcon('heroicon-m-arrow-trending-down'),
            Stat::make('Orders Today', $ordersToday)
                ->description('Orders of the day')
                ->descriptionIcon('heroicon-m-arrow-trending-up'),
        ];
    }
}
