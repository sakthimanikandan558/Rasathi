<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            // United States
            1 => ['Los Angeles', 'San Francisco'],
            2 => ['Houston', 'Dallas'],
            3 => ['New York City', 'Buffalo'],

            // Canada
            4 => ['Toronto', 'Ottawa'],
            5 => ['Vancouver', 'Victoria'],
            6 => ['Montreal', 'Quebec City'],

            // United Kingdom
            7 => ['London', 'Manchester'],
            8 => ['Edinburgh', 'Glasgow'],
            9 => ['Cardiff', 'Swansea'],

            // Australia
            10 => ['Sydney', 'Melbourne'],
            11 => ['Brisbane', 'Gold Coast'],
            12 => ['Hobart', 'Launceston'],

            // Germany
            13 => ['Munich', 'Nuremberg'],
            14 => ['Berlin', 'Potsdam'],
            15 => ['Hamburg', 'Bremen'],
        ];

        foreach ($cities as $stateId => $cityNames) {
            foreach ($cityNames as $cityName) {
                DB::table('cities')->insert([
                    'state_id' => $stateId,
                    'name' => $cityName,
                ]);
            }
        }
    }
}
