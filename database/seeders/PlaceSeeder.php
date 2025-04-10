<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $places = [
            [
                'name' => 'Safe Room',
                'city' => 'Raccoon City',
                'state' => 'Capcom',
            ],
            [
                'name' => 'Observation Deck',
                'city' => 'Silent Hill',
                'state' => 'Konami',
            ],
            [
                'name' => 'Monarch Theatre',
                'city' => 'Gotham City',
                'state' => 'DC Comics',
            ],
            [
                'name' => 'The West Side',
                'city' => 'Metro City',
                'state' => 'SNK',
            ]
        ];

        $places = array_map(function ($place) {
            $place['slug'] = Str::slug($place['name']);
            return $place;
        }, $places);

        DB::table('places')->insert($places);
    }
}
