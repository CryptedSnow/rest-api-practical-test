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
                'name' => 'Jill Valentine',
                'city' => 'Raccoon City',
                'state' => 'Capcom',
            ],
            [
                'name' => 'James Sunderland',
                'city' => 'Silent Hill',
                'state' => 'Konami',
            ],
            [
                'name' => 'Bruce Wayne',
                'city' => 'Gotham City',
                'state' => 'DC Comics',
            ],
            [
                'name' => 'Terry Bogard',
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
