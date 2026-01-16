<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Station;
use Carbon\Carbon;

class GenerateOrderNumberAction
{
    public static function execute(int $stationId): string
    {
        $today = Carbon::today()->format('Ymd');

        $count  = Order::where('station_id', $stationId)->whereDate('created_at', $today)->count();

        $sequence = $count + 1;
        $sequencePadded = str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return "ORD-{$stationId}-{$today}-{$sequencePadded}";
    }
}
