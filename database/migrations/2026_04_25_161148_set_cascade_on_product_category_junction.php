<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ProductCategory', function (Blueprint $table) {
            $table->dropForeign('productcategory_category_id_foreign');
            $table->foreignId('category_id')
                ->change()
                ->constrained('Category')
                ->onDelete('cascade');

            $table->dropForeign('productcategory_product_id_foreign');
            $table->foreignId('product_id')
                ->change()
                ->constrained('Product')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ProductCategory', function (Blueprint $table) {
            $table->dropForeign('productcategory_category_id_foreign');
            $table->foreignId('category_id')
                ->change()
                ->constrained('Category')
                ->onDelete('no action');

            $table->dropForeign('productcategory_product_id_foreign');
            $table->foreignId('product_id')
                ->change()
                ->constrained('Product')
                ->onDelete('no action');
        });
    }
};
