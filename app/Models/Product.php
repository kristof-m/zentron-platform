<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Unguarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Vite;
use Laravel\Scout\Searchable;

#[Table("Product")]
#[Unguarded]
class Product extends Model
{
    use Searchable;

    static array $fallbackImageUrls;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        parent::__construct();

        if (!isset(self::$fallbackImageUrls)) {
            self::$fallbackImageUrls = [
                Vite::asset('resources/images/ps5.jpg'),
                Vite::asset('resources/images/deck.jpg'),
                Vite::asset('resources/images/iphone.jpg'),
                Vite::asset('resources/images/ram.jpg'),
            ];
        }
    }

    public function imageUrls(): array
    {
        $fallbackCount = count(self::$fallbackImageUrls);
        $fallbackIdx = $this->id % $fallbackCount;
        $fallbackPrimary = self::$fallbackImageUrls[$fallbackIdx];
        $fallbackSecondary = self::$fallbackImageUrls[($fallbackIdx + 1) % $fallbackCount];

        $primary = $this->image_url_primary;
        if ($primary === null || trim($primary) === '') {
            $primary = $fallbackPrimary;
        }

        $secondary = $this->image_url_secondary;
        if ($secondary === null || trim($secondary) === '') {
            $secondary = $fallbackSecondary;
        }

        return [$primary, $secondary];
    }

    public function imageUrl(): string
    {
        return $this->imageUrls()[0];
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, "ProductCategory",
            "product_id", "category_id");
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    protected function casts(): array
    {
        return [
            "name" => "string",
            "price" => "decimal:2",
            "description" => "string",
            "color" => "string",
            "image_url_primary" => "string",
            "image_url_secondary" => "string",
        ];
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'color' => $this->color,
            'brand' => $this->brand()->value('name'),
            'categories' => $this->categories()
                ->pluck('name')
                ->implode(' '),
        ];
    }
}
