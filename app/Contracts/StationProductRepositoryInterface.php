<?php

namespace App\Contracts;

use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface StationProductRepositoryInterface
{
    public function getStationProducts(Station $station, Request $request): Collection;
}
