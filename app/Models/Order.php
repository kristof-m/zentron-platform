<?php

namespace App\Models;

use App\Enums\Role;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table("Order")]
class Order extends Model
{
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
        ];
    }
}
