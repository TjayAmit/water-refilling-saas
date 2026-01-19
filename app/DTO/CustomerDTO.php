<?php

namespace App\DTO;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerDTO
{
    public function __construct(
        public string $name,
        public string $phone,
        public string $email,
        public bool $is_trusted,
        public string $notes,
        public ?int $id = null
    ){}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request['name'],
            phone: $request['phone'],
            email: $request['email'],
            is_trusted: $request['is_trusted'] ?? false,
            notes: $request['notes'] ?? '',
        );
    }

    public static function fromModel(Customer $customer): self
    {
        return new self(
            name: $customer->name,
            phone: $customer->phone,
            email: $customer->email,
            is_trusted: $customer->is_trusted,
            notes: $customer->notes,
            id: $customer->id
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'is_trusted' => $this->is_trusted,
            'notes' => $this->notes,
        ];
    }
}
