<?php

namespace App\Services;

use App\Contracts\GameRepositoryContract;
use App\Contracts\GameServiceContract;
use App\Contracts\GenreRepositoryContract;
use App\Contracts\StudioRepositoryContract;
use App\Exceptions\GameException;
use App\Models\Game;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class GameService implements GameServiceContract
{
    private GameRepositoryContract $gamesRepository;
    private StudioRepositoryContract $studioRepository;
    private GenreRepositoryContract $genreRepository;

    public function __construct(GameRepositoryContract $gamesRepository,
    StudioRepositoryContract $studioRepository,
    GenreRepositoryContract $genreRepository)
    {
        $this->gamesRepository = $gamesRepository;
        $this->studioRepository = $studioRepository;
        $this->genreRepository = $genreRepository;
    }

    public function getGames()
    {
        return $this->gamesRepository->getGames();
    }

    public function getGameById($id)
    {
        return $this->gamesRepository->getGameById($id);
    }

    public function getGamesByGenre(array $genres): Collection
    {
        return $this->genreRepository->getGamesByGenres($genres['genres']);
    }

    /**
     * @throws GameException
     */
    public function create(array $data): bool
    {
        try {
            DB::transaction(function () use ($data) {
                $genres = collect();

                $studioId = $this->studioRepository->getOrCreateStudio($data['studio'])->id;

                foreach ($data['genres'] as $genre) {
                    $genres->add($this->genreRepository->getOrCreateGenres($genre));
                }

                $data = [
                    'title'     => $data['title'],
                    'studio_id' => $studioId,
                ];

                $game = $this->gamesRepository->create($data);

                $genres->each(function ($genre) use ($game) {
                    return $game->genres()->save($genre);
                });
            });
        } catch (Exception $e) {
            throw new GameException('Произошла ошибка. Данные не записались в базу данных.');
        }

        return true;
    }

    /**
     * @throws GameException
     */
    public function update($id, array $data): bool
    {
        try {
            DB::transaction(function () use ($id, $data) {
                $genres = collect();

                $fields = [
                    'title' => $data['title']
                ];

                if(isset($data['studio'])) {
                    $studioId = $this->studioRepository->getOrCreateStudio($data['studio'])->id;
                    $fields['studio_id'] = $studioId;
                }

                $game = $this->gamesRepository->update($id, $fields);

                if(isset($data['genres'])) {
                    foreach ($data['genres'] as $genre) {
                        $genres->add($this->genreRepository->getOrCreateGenres($genre));
                    }

                    $game->genres()->detach();
                    $genres->each(function ($genre) use ($game) {
                        return $game->genres()->save($genre);
                    });
                }
            });
        } catch (Exception $e) {
                throw new GameException('Произошла ошибка. Не получилось обновить данные.');
        }

        return true;
    }

    /**
     * @throws GameException
     */
    public function delete(Game $game)
    {
        try {
            return $this->gamesRepository->delete($game);
        } catch (Exception $e) {
            throw new GameException('Не получилось удалить запись.');
        }
    }
}
