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

        $order->contact_name = $validated['name'];
        $order->contact_phone = $validated['phone-number'];
        $order->contact_email = $validated['email'];

        $order->address_1 = $validated['address-1'];
        $order->address_2 = $validated['address-2'];
        $order->zip = $validated['zip'];
        $order->city = $validated['city'];
        $order->country = $validated['country'];

        $order->save();

        return redirect()->route('checkout.review');
    }
}
