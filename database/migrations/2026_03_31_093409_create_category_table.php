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
        Schema::create('Category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });

        Schema::create('ProductCategory', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->references('id')
                ->on('Category');
            $table->foreignId('product_id')
                ->references('id')
                ->on('Product');
            $table->primary(['category_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProductCategory');
        Schema::dropIfExists('Category');
    }
};
