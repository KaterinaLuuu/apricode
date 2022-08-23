<?php

namespace App\Contracts;

use App\Models\Game;
use Illuminate\Database\Eloquent\Collection;

interface GameServiceContract
{
    public function getGameById($id);

    public function getGames();

    public function getGamesByGenre(array $genres): Collection;

    public function create(array $data): bool;

    public function update($id, array $data): bool;

    public function delete(Game $game);
}
