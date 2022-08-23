<?php

namespace App\Providers;

use App\Contracts\GameRepositoryContract;
use App\Contracts\GameServiceContract;
use App\Contracts\GenreRepositoryContract;
use App\Contracts\StudioRepositoryContract;
use App\Repositories\GameRepository;
use App\Repositories\GenreRepository;
use App\Repositories\StudioRepository;
use App\Services\GameService;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(GameRepositoryContract::class, GameRepository::class);
        $this->app->singleton(GameServiceContract::class, GameService::class);
        $this->app->singleton(GenreRepositoryContract::class, GenreRepository::class);
        $this->app->singleton(StudioRepositoryContract::class, StudioRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
