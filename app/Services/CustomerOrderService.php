<?php

namespace App\Services;

use App\Contracts\OrderRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerOrderService
{
    public function __construct(
        protected OrderRepositoryInterface $interface
    ){}

    public function getOrdersByRecentDate(Request $request): LengthAwarePaginator
    {
        return $this->interface->getCustomerOrders($request);
    }
}
