<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
                'state' => 'Capcom',
                'city' => 'Raccoon City',
            ],
            [
                'name' => 'Observation Deck',
                'state' => 'Konami',
                'city' => 'Silent Hill',
            ],
            [
                'name' => 'Monarch Theatre',
                'state' => 'DC Comics',
                'city' => 'Gotham City',
            ],
            [
                'name' => 'The West Side',
                'state' => 'Capcom',
                'city' => 'Metro City',
            ]
        ];

        $places = array_map(function ($place) {
            $place['slug'] = Str::slug($place['name']);
            $place['created_at'] = Carbon::now();
            $place['updated_at'] = Carbon::now();
            return $place;
        }, $places);

        DB::table('places')->insert($places);
    }
}
