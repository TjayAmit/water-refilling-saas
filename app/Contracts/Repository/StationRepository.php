<?php

namespace App\Contracts\Repository;

use App\Contracts\StationRepositoryInterface;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StationRepository implements StationRepositoryInterface
{
    public function getAll(Request $request): Collection
    {
        return Station::all();
    }
}
