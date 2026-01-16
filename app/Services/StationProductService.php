<?php

namespace App\Services;

use App\Contracts\StationProductRepositoryInterface;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StationProductService
{
    public function __construct(
        protected StationProductRepositoryInterface $interface
    ){}

    public function getAll(Station $station, Request $request): Collection
    {
        return $this->interface->getStationProducts($station, $request);
    }
}
