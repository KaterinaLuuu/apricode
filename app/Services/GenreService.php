<?php

namespace App\Services;

use App\Contracts\GenreRepositoryContract;
use App\Contracts\GenreServiceContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GenreService implements GenreServiceContract
{

    public function __construct(private GenreRepositoryContract $genreRepository)
    {
    }

    public function getOrCreateGenre($genreName): Model
    {
        $genre = $this->genreRepository->findByGenreName($genreName);

        if (is_null($genre)) {
            $genre = $this->genreRepository->createGenre($genreName);
        }

        return $genre;
    }

    public function getGamesByGenres(array $genres): Collection
    {
        return $this->genreRepository->getGamesByGenres($genres);
    }
}
