<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            // United States
            ['country_id' => 1, 'name' => 'California'],
            ['country_id' => 1, 'name' => 'Texas'],
            ['country_id' => 1, 'name' => 'New York'],

            // Canada
            ['country_id' => 2, 'name' => 'Ontario'],
            ['country_id' => 2, 'name' => 'British Columbia'],
            ['country_id' => 2, 'name' => 'Quebec'],

            // United Kingdom
            ['country_id' => 3, 'name' => 'England'],
            ['country_id' => 3, 'name' => 'Scotland'],
            ['country_id' => 3, 'name' => 'Wales'],

            // Australia
            ['country_id' => 4, 'name' => 'New South Wales'],
            ['country_id' => 4, 'name' => 'Queensland'],
            ['country_id' => 4, 'name' => 'Victoria'],

            // Germany
            ['country_id' => 5, 'name' => 'Bavaria'],
            ['country_id' => 5, 'name' => 'Berlin'],
            ['country_id' => 5, 'name' => 'Hamburg'],
        ]);
    }
}
