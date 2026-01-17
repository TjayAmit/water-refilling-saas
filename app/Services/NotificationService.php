<?php

namespace App\Services;

use App\Contracts\NotificationRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;

class NotificationService
{
    public function __construct(
        protected NotificationRepositoryInterface $repository
    ){}

    public function getMyNotification(): Collection
    {
        return $this->repository->getMyNotifications();
    }

    public function unreadCount(): int
    {
        return $this->repository->unreadNotificationsCount();
    }

    public function markAsRead(DatabaseNotification $notification): DatabaseNotification
    {
        abort_if($notification->notifiable_id !== auth()->id(), 403);

        return $this->repository->markAsRead($notification);
    }

    public function markAllAsRead(): Collection
    {
        return $this->repository->marAllAsRead();
    }
}
