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
        Schema::table('OrderProduct', function (Blueprint $table) {
            $table->dropForeign('orderproduct_order_id_foreign');
            $table->foreignId('order_id')
                ->change()
                ->constrained('Order')
                ->onDelete('cascade');

            $table->dropForeign('orderproduct_product_id_foreign');
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
        Schema::table('OrderProduct', function (Blueprint $table) {
            $table->dropForeign('orderproduct_order_id_foreign');
            $table->foreignId('order_id')
                ->change()
                ->constrained('Order')
                ->onDelete('no action');

            $table->dropForeign('orderproduct_product_id_foreign');
            $table->foreignId('product_id')
                ->change()
                ->constrained('Product')
                ->onDelete('no action');
        });
    }
};
