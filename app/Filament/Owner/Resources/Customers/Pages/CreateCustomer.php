<?php

namespace App\Filament\Owner\Resources\Customers\Pages;

use App\Filament\Owner\Resources\Customers\CustomerResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;
}
