<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {

        $orders = Order::orderBy('id', 'DESC')
            ->get()
            ->map(function ($data) {
                $order['order_number']   = $data->id;
                $order['payment_method'] = $data->payment_method;
                $order['order_date']     = $data->created_at->diffForHumans();
                $order['amount']         = $data->total;
                $order['status']         = $data->status;
                return $order;
            });

        if (empty($orders)) {
            return response()->json(['message' => 'Not Found', 'success' => 0], 200);
        }
        return response()->json(['data' => $orders, 'success' => 1, 'message' => 'successful'], 200);
    }
}
