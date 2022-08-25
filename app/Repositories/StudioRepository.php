<?php

namespace App\Repositories;

use App\Contracts\StudioRepositoryContract;
use App\Models\Studio;
use Illuminate\Database\Eloquent\Model;

class StudioRepository implements StudioRepositoryContract
{
    public function findByStudioName($studioName): ?Model
    {
        return Studio::where('title', $studioName)->first();
    }

    public function createStudio($studioName): Model
    {
        $newStudio = new Studio(['title' => $studioName]);
        $newStudio->save();
        return $newStudio;
    }
}
