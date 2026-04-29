<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('order', compact('order'));
    }

    public function all()
    {
        if (auth()->guest()) {
            return redirect('/');
        }

        $user = auth()->user();
        $orders = $user->orders()
            ->where('total_amount', '>', 0)
            ->orderBy('created_at')
            ->get();
        return view('all-orders', compact('orders'));
    }
}
