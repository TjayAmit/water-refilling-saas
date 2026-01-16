<?php

namespace App\Services;

use App\Contracts\StationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class StationService
{
    public function __construct(
        protected StationRepositoryInterface $interface
    ){}

    public function getAll(Request $request): Collection
    {
        return $this->interface->getAll($request);
    }
}
