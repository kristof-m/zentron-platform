<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = new DeliveryType;
        $type->name = 'Packeta';
        $type->price = 2.49;
        $type->save();

        $type = new DeliveryType;
        $type->name = 'FedEx';
        $type->price = 3.79;
        $type->save();
    }
}
