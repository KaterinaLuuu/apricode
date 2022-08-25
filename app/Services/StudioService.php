<?php

namespace App\Services;

use App\Contracts\StudioRepositoryContract;
use App\Contracts\StudioServiceContract;
use Illuminate\Database\Eloquent\Model;

class StudioService implements StudioServiceContract
{

    public function __construct(private StudioRepositoryContract $studioRepository)
    {
    }

    public function getOrCreateStudio($studioName): Model
    {
        $studio = $this->studioRepository->findByStudioName($studioName);

        if (is_null($studio)) {
            $studio = $this->studioRepository->createStudio($studioName);
        }

        return $studio;
    }

}
