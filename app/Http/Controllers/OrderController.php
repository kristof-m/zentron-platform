<?php

namespace App\Http\Controllers;

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
        return view('all-orders', compact('user'));
    }
}
