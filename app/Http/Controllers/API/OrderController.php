<?php
// app/Http/Controllers/API/OrderController.php

namespace App\Http\Controllers\API;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        return Order::where('user_id', Auth::id())->orderByDesc('created_at')->get();
    }

    public function show($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return response()->json($order);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array',
            'total' => 'required|numeric',
            'shipping_address' => 'required|array',
            'payment_method' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'items' => $data['items'],
            'total' => $data['total'],
            'shipping_address' => $data['shipping_address'],
            'payment_method' => $data['payment_method'],
            'estimated_delivery' => now()->addDays(7),
        ]);

        return response()->json(['success' => true, 'order' => $order]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,processing,shipped,delivered,cancelled']);

        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $order->status = $request->status;
        $order->save();

        return response()->json(['success' => true, 'order' => $order]);
    }
}
