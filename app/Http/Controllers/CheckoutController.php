<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(Request $request): View
    {
        $order = Order::getCurrentOrder($request);
        return view('checkout', compact('order'));
    }

    public function setDetails(Request $request)
    {
        $order = Order::getCurrentOrder($request);
        $validated = $request->validate([
            'name' => 'required|string',

            'address-1' => 'required|string',
            'address-2' => 'nullable|string',
            'zip' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',

            'email' => 'required|string',
            'phone-number' => 'nullable|string',
        ]);

        return redirect()->route('checkout.review');
    }
}
