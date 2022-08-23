<?php

namespace App\Repositories;

use App\Contracts\GameRepositoryContract;
use App\Models\Game;

class GameRepository implements GameRepositoryContract
{
    private Game $model;

    public function __construct(Game $model)
    {
        $this->model = $model;
    }

    public function getGameById($id)
    {
        return $this->model->where('id', $id)->with(['studios', 'genres'])->get();
    }

    public function getGames()
    {
        return $this->model->with(['studios', 'genres'])->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model = $this->model->find($id);
        $model->update($data);

        return $model;
    }

    public function delete(Game $game): ?bool
    {
        return $game->delete();
    }
}
