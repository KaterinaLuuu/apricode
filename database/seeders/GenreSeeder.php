<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Виртуальная реальность',
            'Инди-игра',
            'Квест',
            'Головоломка',
            'Survival horror',
            'Ролевые игры',
            'Экшены',
        ];

        foreach ($genres as $genre) {
            Genre::factory()->create(['title' => $genre]);
        }
    }
}
