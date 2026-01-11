<?php

namespace App\Http\Controllers\StationBusinessManagement;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Services\OrderService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function __construct(
        protected OrderService $service
    ){}
    /**
     * Display list of to deliver
     *
     */
    public function index(Request $request)
    {
        return $this->service->getOrderByStationIdAndStatus($request);
    }

    /**
     * View order to deliver
     * Order details
     * Delivery Route/Location
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Update order status [Delivered/Cancelled]
     */
    public function update(Request $request, Delivery $delivery)
    {
        //
    }
}
