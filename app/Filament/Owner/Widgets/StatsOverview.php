<?php

namespace App\Filament\Owner\Widgets;

use App\Models\Order;
use App\Models\Station;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{

    protected function getStats(): array
    {
        $totalStations = Station::where('owner_id', auth()->id())->count();

        $stationsIncrease = Station::where('owner_id', auth()->id())
            ->whereDate('created_at', today())
            ->count();

        $overduePlanToPay = Order::whereHas('station', function($query) {
                $query->where('owner_id', auth()->id());
            })
            ->where('status', 'overdue')
            ->count();

        $ordersToday = Order::whereHas('station', function($query) {
                $query->where('owner_id', auth()->id());
            })
            ->whereDate('created_at', today())->count();

        return [
            Stat::make('Total Branch', $totalStations)
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
