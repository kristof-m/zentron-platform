<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;

#[Table("Product")]
class Product extends Model
{
    protected function casts(): array
    {
        return [
            "name" => "string",
            "price" => "decimal:2",
            "description" => "string",
        ];
    }
}
