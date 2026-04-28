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
        Schema::create('ProductImage', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url');
            $table->foreignId('product_id')
                ->constrained('Product');
        });

        Schema::table('Product', function (Blueprint $table) {
            $table->foreignId('main_image_id')
                ->nullable()
                ->constrained('ProductImage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Product', function (Blueprint $table) {
            $table->dropConstrainedForeignId('main_image_id');
        });

        Schema::dropIfExists('ProductImage');
    }
};
