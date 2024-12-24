<?php

namespace Database\Seeders;

use App\Models\seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        seller::create([
            'name' => 'ABC Electronics',
        ]);
    }
}
