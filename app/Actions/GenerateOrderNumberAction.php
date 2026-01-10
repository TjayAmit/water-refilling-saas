<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\Station;
use Carbon\Carbon;

class GenerateOrderNumberAction
{
    function execute(Station $station): string
    {
        $today = Carbon::today()->format('Ymd');

        $count  = Order::where('station_id', $station->id)->whereDate('created_at', $today)->count();

        $sequence = $count + 1;
        $sequencePadded = str_pad($sequence, 4, '0', STR_PAD_LEFT);

        return "ORD-{$station->id}-{$today}-{$sequencePadded}";
    }
}
