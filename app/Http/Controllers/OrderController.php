<?php

namespace App\Http\Controllers;

use App\Http\Service\OrderService;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            return response()->json([
                "data" => $this->orderService->search($request->all()),
            ],200);
        } catch (Exception $e) {
            throw new \RuntimeException($e->getMessage());
        }

    }

}
