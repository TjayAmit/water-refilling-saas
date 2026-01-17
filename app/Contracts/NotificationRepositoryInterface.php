<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;

interface NotificationRepositoryInterface
{
    public function getMyNotifications(): Collection;
    public function unreadNotificationsCount(): int;
    public function markAsRead(DatabaseNotification $notification): DatabaseNotification;
    public function marAllAsRead(): Collection;
}
