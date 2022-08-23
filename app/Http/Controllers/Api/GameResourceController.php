<?php

namespace App\Http\Controllers\Api;

use App\Contracts\GameServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\GameCreateRequest;
use App\Http\Requests\GamesByGenresRequest;
use App\Http\Requests\GameUpdateRequest;
use App\Http\Resources\GameResource;
use App\Http\Resources\GamesByGenresResource;
use App\Models\Game;
use Illuminate\Http\JsonResponse;

class GameResourceController extends Controller
{
    private GameServiceContract $gameService;

    public function __construct(GameServiceContract $gameServiceContract)
    {
        $this->gameService = $gameServiceContract;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(GameResource::collection($this->gameService->getGames()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GameCreateRequest $request
     * @return JsonResponse
     */
    public function store(GameCreateRequest $request): JsonResponse
    {
        return response()->json(['success' => $this->gameService->create($request->validated())]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(GameResource::collection($this->gameService->getGameById($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GameUpdateRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(GameUpdateRequest $request, int $id): JsonResponse
    {
        return response()->json(['success' => $this->gameService->update($id, $request->validated())]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Game $game
     * @return JsonResponse
     */
    public function destroy(Game $game): JsonResponse
    {
        return new JsonResponse(['success' => $this->gameService->delete($game)]);
    }

    public function gamesByGenre(GamesByGenresRequest $genres)
    {
        return response()
            ->json(GamesByGenresResource::collection($this->gameService->getGamesByGenre($genres->validated())));
    }
}
