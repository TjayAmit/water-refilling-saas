<?php

namespace App\Contracts;

use App\DTO\CustomerDTO;
use App\Models\Customer;
use App\Models\Order;

interface CustomerRepositoryInterface
{
    public function getEmployeeByOrderId(Order $order): Customer;
    public function create(CustomerDTO $dto): Customer;
}
