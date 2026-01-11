<?php

namespace App\Http\Controllers\StationBusinessManagement;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Services\OrderItemService;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function __construct(
        protected OrderItemService $service
    ){}

    /**
     * Display list of order items by station id
     *
     * Total order items to deliver today
     * Can be used for owner viewing summary of to deliver items
     */
    public function index(Request $request)
    {
        return $this->service->getOrderItemsViaOrderDeliveryDate($request);
    }
}
