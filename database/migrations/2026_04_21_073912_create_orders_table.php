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
        Schema::create('DeliveryType', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->string('name');
            $table->decimal('price');
        });

        Schema::create('Order', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('User');

            $table->enum('status', ['in_cart', 'confirmed', 'paid', 'shipped'])
                ->default('in_cart');

            $table->string('contact_name')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();

            $table->string('delivery_address')->nullable();
            $table->foreignId('delivery_type_id')
                ->nullable()
                ->constrained('DeliveryType');

            $table->decimal('total_amount');
        });

        Schema::create('OrderProduct', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->references('id')
                ->on('Order');
            $table->foreignId('product_id')
                ->references('id')
                ->on('Product');
            $table->primary(['order_id', 'product_id']);

            $table->integer('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OrderProduct');
        Schema::dropIfExists('Order');
        Schema::dropIfExists('DeliveryType');
    }
};
