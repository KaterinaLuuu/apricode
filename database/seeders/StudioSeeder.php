<?php

namespace Database\Seeders;

use App\Models\Studio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studios = [
            'Roll7',
            'Guerrilla Games',
            'Bungie',
            'FromSoftware Inc.',
            'Kinetic Games',
        ];

        foreach ($studios as $studio) {
            Studio::factory()->create(['title' => $studio]);
        }
    }
}
