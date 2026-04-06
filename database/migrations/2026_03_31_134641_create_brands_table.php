<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('Brand', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });

        Schema::table('Product', function (Blueprint $table) {
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('Brand');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Brand');
        Schema::table('Product', function (Blueprint $table) {
            $table->dropConstrainedForeignId('brand_id');
        });
    }
};
