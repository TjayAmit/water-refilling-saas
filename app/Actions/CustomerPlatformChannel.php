<?php

namespace App\Actions;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class CustomerPlatformChannel
{
    public static function execute($notifiable, Notification $notification): bool
    {
        if (method_exists($notifiable, 'toCustomerPlatform')) {
            $data = $notifiable->toCustomerPlatform($notification);

            $result = Http::post($notifiable->platform_webhook_url, $data);

            if ($result->successful()) {
                return true;
            }
        }

        return false;
    }
}
