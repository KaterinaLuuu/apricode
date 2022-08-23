<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface GenreRepositoryContract
{
    public function getOrCreateGenres(string $genre): Model;

    public function getGamesByGenres(array $genres): Collection;
}
