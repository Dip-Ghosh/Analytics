<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderValidationRequest;
use App\Http\Service\OrderService;
use Exception;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function search(OrderValidationRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                "data"   => $this->orderService->search($request->all()),
                "status" => "success",
            ], 200);
        } catch (Exception $e) {
           throw new Exception($e->getMessage());
        }
    }
}
