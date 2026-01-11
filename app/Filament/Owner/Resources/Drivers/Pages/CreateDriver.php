<?php

namespace App\Filament\Owner\Resources\Drivers\Pages;

use App\Filament\Owner\Resources\Drivers\DriverResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;

class CreateDriver extends CreateRecord
{
    protected static string $resource = DriverResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        // Prepare driver data
        $data['user_id'] = $user->id;
        unset($data['email'], $data['password']);

        return $data;
    }
}
