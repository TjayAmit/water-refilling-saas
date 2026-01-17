<?php

namespace App\Http\Controllers\RestApis;

use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected NotificationService $service
    ){}

    public function index(Request $request): JsonResponse
    {
        return $this->apiResponse(function() use ($request) {
            return $this->service->getMyNotification();
        });
    }

    public function unreadCount(): JsonResponse
    {
        return $this->apiResponse(function() {
            return $this->service->unreadCount();
        });
    }

    public function markAsRead(DatabaseNotification $notification, Request $request): JsonResponse
    {
        return $this->apiResponse(function() use ($notification) {
            return $this->service->markAsRead($notification);
        });
    }

    public function markAllAsRead(): JsonResponse
    {
        return $this->apiResponse(function() {
            return $this->service->markAllAsRead();
        });
    }
}
