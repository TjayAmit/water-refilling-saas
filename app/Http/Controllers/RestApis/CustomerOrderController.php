<?php

namespace App\Http\Controllers\RestApis;

use App\Http\Controllers\Controller;
use App\Services\CustomerOrderService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    use ApiResponse;

    public function __construct(
        protected CustomerOrderService $service
    ){}

    public function index(Request $request): JsonResponse
    {
        return $this->apiResponse(function() use ($request) {
            return $this->service->getOrdersByRecentDate($request);
        });
    }
}
