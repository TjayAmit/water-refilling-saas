<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProducts extends CreateRecord
{
    protected static string $resource = ProductsResource::class;
}
