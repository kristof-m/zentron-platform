<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table("Product")]
class Product extends Model
{
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "ProductCategory",
            "product_id", "category_id");
    }

    protected function casts(): array
    {
        return [
            "name" => "string",
            "price" => "decimal:2",
            "description" => "string",
        ];
    }
}
