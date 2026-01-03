<?php

namespace App\Filament\Owner\Resources\Users\Pages;

use App\Filament\Owner\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
