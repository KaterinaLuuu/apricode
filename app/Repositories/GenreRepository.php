<?php

namespace App\Repositories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\GenreRepositoryContract;

class GenreRepository implements GenreRepositoryContract
{
    public function findByGenreName($genreName): ?Model
    {
        return Genre::where('title', $genreName)->first();
    }

    public function createGenre($genreName): Model
    {
        $newGenre = new Genre(['title' => $genreName]);
        $newGenre->save();
        return $newGenre;
    }

    public function getGamesByGenres(array $genres): Collection
    {
        return Genre::whereIn('title', $genres)->with('games')->get();
    }
}
