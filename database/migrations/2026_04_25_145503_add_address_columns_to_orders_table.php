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
        Schema::table('Order', function (Blueprint $table) {
            $table->renameColumn('delivery_address', 'address_1');
            $table->string("address_2")->nullable();

            $table->string("zip")->default('00000');
            $table->string("city")->nullable();
            $table->string("country")->default('SK');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Order', function (Blueprint $table) {
            $table->renameColumn('address_1', 'delivery_address');

            $table->dropColumn("address_2");
            $table->dropColumn("zip");
            $table->dropColumn("city");
            $table->dropColumn("country");
        });
    }
};
