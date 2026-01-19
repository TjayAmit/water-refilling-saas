<?php

namespace App\Actions;

use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class CustomerPlatformChannel
{
    public function execute($notifiable, Notification $notification)
    {
        if (method_exists($notifiable, 'routeNotificationForWebHook')) {
            $data = $notifiable->routeNotificationForWebHook($notification);

            Http::post($notifiable->platform_webhook_url, $data);
        }
    }
}
