<?php

namespace App\Filament\Owner\Resources\Products\Pages;

use App\Filament\Owner\Resources\Products\ProductResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
}
