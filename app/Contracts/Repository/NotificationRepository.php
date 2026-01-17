<?php

namespace App\Contracts\Repository;

use App\Contracts\NotificationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;

class NotificationRepository implements NotificationRepositoryInterface
{

    public function getMyNotifications(): Collection
    {
        return auth()->user()->notifications();
    }

    public function unreadNotificationsCount(): int
    {
        return  auth()->user()->unreadNotifications()->count();
    }

    public function markAsRead(DatabaseNotification $notification): DatabaseNotification
    {
        $notification->markAsRead();

        return $notification;
    }

    public function marAllAsRead(): Collection
    {
        return auth()->user()->notifications()->unreadNotifications->update(['read_at' => now()]);
    }
}
