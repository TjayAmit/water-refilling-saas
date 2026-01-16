<?php

namespace App\Contracts\Repository;

use App\Contracts\StationProductRepositoryInterface;
use App\Models\Station;
use App\Models\StationProduct;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StationProductRepository implements StationProductRepositoryInterface
{
    public function getStationProducts(Station $station, Request $request): Collection
    {
        $search = $request->get('search');

        return StationProduct::when($search, function ($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })
            ->where('station_id', $station->id)
            ->get();
    }
}
