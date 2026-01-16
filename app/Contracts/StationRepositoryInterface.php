<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface StationRepositoryInterface
{
    public function getAll(Request $request): Collection;
}
