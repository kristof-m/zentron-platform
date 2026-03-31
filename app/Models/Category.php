<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table('Category')]
class Category extends Model
{
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, "ProductCategory",
            "category_id", "product_id");
    }

    protected function casts(): array
    {
        return [
            "name" => "string",
        ];
    }
}
