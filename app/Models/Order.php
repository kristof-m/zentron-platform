<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\Role;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Http\Request;

#[Table("Order")]
class Order extends Model
{
    public static function getCurrentOrder(Request $request): Order
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

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "OrderProduct",
            "order_id", "product_id")
            ->withPivot("amount");
    }

    public function updateTotalAmount(): void
    {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->price * $product->pivot->amount;
        }

        $this->total_amount = $total;
        $this->save();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "current_order_id" => "int",
            "total_amount" => "int",
        ];
    }
}
