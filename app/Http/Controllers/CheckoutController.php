<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function show(Request $request): View
    {
        $order = Order::getCurrentOrder($request);
        return view('checkout', ['order' => $order, 'isReview' => false]);
    }

    public function review(Request $request): View
    {
        $order = Order::getCurrentOrder($request);
        return view('checkout', ['order' => $order, 'isReview' => true]);
    }

    public function payment(Request $request): View
    {
        $order = Order::getCurrentOrder($request);
        return view('checkout.payment', ['order' => $order]);
    }

    public function complete(Request $request): View
    {
        $order = Order::getCurrentOrder($request);
        return view('checkout.complete', ['order' => $order]);
    }

    public function confirm(Request $request)
    {
        $order = Order::getCurrentOrder($request);
        $order->status = OrderStatus::Confirmed;
        $order->save();

        return redirect(route('checkout.payment'));
    }

    public function acceptPayment(Request $request)
    {
        $order = Order::getCurrentOrder($request);
        $order->status = OrderStatus::Paid;
        $order->save();

        $user = auth()->user();
        if ($user) {
            // current order is complete, clear it out
            $user->current_order_id = null;
            $user->save();
        }

        return redirect(route('checkout.complete'));
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
