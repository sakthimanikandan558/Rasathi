<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
Use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'name' => 'United States',
                'code' => 'US',
                'phonecode' => '1',
            ],
            [
                'name' => 'Canada',
                'code' => 'CA',
                'phonecode' => '1',
            ],
            [
                'name' => 'United Kingdom',
                'code' => 'GB',
                'phonecode' => '44',
            ],
            [
                'name' => 'Australia',
                'code' => 'AU',
                'phonecode' => '61',
            ],
            [
                'name' => 'Germany',
                'code' => 'DE',
                'phonecode' => '49',
            ],
        ]);
    }
}
