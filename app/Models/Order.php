<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table("Order")]
class Order extends Model
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "OrderProduct",
            "product_id", "order_id");
    }
}
