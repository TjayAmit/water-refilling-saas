<?php

namespace App\Filament\Owner\Resources\Drivers\Pages;

use App\Filament\Owner\Resources\Drivers\DriverResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDriver extends EditRecord
{
    protected static string $resource = DriverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load user data
        $data['name'] = $this->record->user->name;
        $data['email'] = $this->record->user->email;

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update user
        $this->record->user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => filled($data['password'])
                ? bcrypt($data['password'])
                : $this->record->user->password,
        ]);

        // Remove user fields
        unset($data['email'], $data['password']);

        return $data;
    }
}
