<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface GenreRepositoryContract
{
    public function findByGenreName($genreName): ?Model;

    public function createGenre($genreName): Model;

    public function getGamesByGenres(array $genres): Collection;
}
