<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\GenreRepositoryContract;

class GenreRepository implements GenreRepositoryContract
{
    public function getOrCreateGenres(string $genre): Model
    {
        return Genre::firstOrCreate(['title' => $genre]);
    }

    public function getGamesByGenres(array $genres): Collection
    {
        return Genre::whereIn('title', $genres)->with('games')->get();
    }
}
