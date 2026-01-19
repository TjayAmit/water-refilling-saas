<?php

namespace App\Contracts\Repository;

use App\Contracts\CustomerRepositoryInterface;
use App\DTO\CustomerDTO;
use App\Models\Customer;
use App\Models\Order;

class CustomerRepository implements CustomerRepositoryInterface
{

    public function getEmployeeByOrderId(Order $order): Customer
    {
        return $order->customer;
    }

    public function create(CustomerDTO $dto): Customer
    {
        return Customer::create($dto->toArray());
    }
}
