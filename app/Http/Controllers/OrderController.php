<?php

namespace App\Http\Controllers;

use App\Http\Service\OrderService;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
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
