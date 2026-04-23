<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    private function getCurrentOrder(Request $request): Order
    {
        /* @var $order ?Order */
        if (auth()->guest()) {
            $orderId = $request->session()->get("orderId");

            if ($orderId == null) {
                $order = new Order;
                $order->status = OrderStatus::InCart;
                $order->total_amount = 0;
                $order->save();

                $request->session()->put("orderId", $order->id);
            } else {
                $order = Order::find($orderId);
                // prevent order from expiring too early
                $order->touch();
            }
        } else {
            $user = auth()->user();
            $order = $user->currentOrder;
            if ($order == null) {
                $order = new Order;
                $order->status = OrderStatus::InCart;
                $order->total_amount = 0;
                $order->user_id = $user->id;
                $order->save();

                $user->current_order_id = $order->id;
                $user->save();
            }
        }

        return $order;
    }

    public function show(Request $request): View
    {
        $order = $this->getCurrentOrder($request);

        $products = $order->products;

        $entries = [];
        foreach ($products as $product) {
            /* @var $product Product */
            $entries[$product->id] = $product->pivot->amount;
        }

        return view('cart', [
            'products' => $products,
            'amounts' => $entries,
            'totalPrice' => $order->total_amount,
        ]);
    }

    public function setAmount(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:Product,id',
            'amount' => 'required|integer|min:1',
        ]);
        /* @var $id int */
        $id = $validated['id'];
        /* @var $amount int */
        $amount = $validated['amount'];

        $order = $this->getCurrentOrder($request);

        // add OrderProduct instance to database
        $order->products()->syncWithoutDetaching([$id => ['amount' => $amount]]);

        $order->updateTotalAmount();

        return redirect()->route('cart');
    }

    public function remove(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:Product,id',
        ]);
        /* @type $id int */
        $id = $validated['id'];

        $order = $this->getCurrentOrder($request);

        // add OrderProduct instance to database
        $order->products()->detach([$id]);
        $order->updateTotalAmount();

        return redirect()->route('cart');
    }
}
