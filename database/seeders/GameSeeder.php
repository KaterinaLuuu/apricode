<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Genre;
use App\Models\Studio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studios = Studio::get();

        $games = [
            'OlliOlli World',
            'Horizon Forbidden West',
            'Destiny 2: The Witch Queen',
            'Elden Ring',
            'Phasmophobia',
        ];

        foreach ($games as $game) {
            Game::factory()->create([
                'title' => $game,
                'studio_id' => $studios->random(),
            ]);
        }

        $games = Game::get();
        $genres = Genre::get();

        $games->each(function($game) use ($genres) {
            $count = rand(1, 3);
            $existIds = [];

            for ($i = 0; $i<$count; $i++) {
                $randomGenre = $genres->random();

                while (in_array($randomGenre->id, $existIds)) {
                    $randomGenre = $genres->random();
                }

                $existIds[] = $game->genres()->save($randomGenre)->id;
            }
        });
    }
}
