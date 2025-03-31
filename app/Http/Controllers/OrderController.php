<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'status' => 'required|in:pending,paid,shipped,completed,canceled',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = Order::create($request->only(['user_id', 'total_price', 'status']));
        foreach ($request->items as $item) {
            $order->orderItems()->create($item);
        }
        return response()->json($order, 201);
    }

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'sometimes|required|exists:users,id',
            'total_price' => 'sometimes|required|numeric',
            'status' => 'sometimes|required|in:pending,paid,shipped,completed,canceled',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $order = Order::findOrFail($id);
        $order->update($request->only(['user_id', 'total_price', 'status']));
        return response()->json($order, 200);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json(null, 204);
    }

    public function getOrders()
    {
        $orders = Order::all();
        return response()->json($orders, 200);
    }

    public function getOrderById($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order, 200);
    }
}
