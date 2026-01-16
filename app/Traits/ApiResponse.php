<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function apiResponse(callable $callback): JsonResponse
    {
        $result = $callback();

        $caller = $this->extractCaller();

        $class_name = $caller['class'] ?? null;
        $method = $caller['method'] ?? null;

        return match($class_name) {
            'StationController' => match($method) {
                'index' => response()->json($result, 200),
                default => response()->json(['data' => $result, 'message' => "Retrieve list of stations."], 200),
            },
            'OrderController' => match($method) {
                'index' => response()->json($result, 200),
                'store' => response()->json(['data' => $result, 'message' => "Your order has been place please prepare exact amount."], 201),
                default => response()->json(['data' => $result, 'message' => "Retrieve list of orders."], 200),
            },
            'StationProductController' => match($method) {
                'index' => response()->json($result, 200),
                default => response()->json(['data' => $result, 'message' => "Retrieve list of station products."], 200),
            },
            default => response()->json($result, 200),
        };
    }


    private function extractCaller(): array
    {
        $trace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 5);

        $full_controller_path = $trace[5]['class'] ?? null;

        return [
            'class' => class_basename($full_controller_path),
            'method' => $trace[4]['function'] ?? null,
        ];
    }
}
