<?php

namespace App\Repositories;

use App\Contracts\StudioRepositoryContract;
use App\Models\Studio;

class StudioRepository implements StudioRepositoryContract
{
    public function getOrCreateStudio($studio)
    {
        return Studio::firstOrCreate(['title' => $studio]);
    }
}
