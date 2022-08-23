<?php

namespace App\Contracts;

use App\Models\Game;

interface GameRepositoryContract
{
    public function getGameById($id);

    public function getGames();

    public function create($data);

    public function update($id, $data);

    public function delete(Game $game);
}
