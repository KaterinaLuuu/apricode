<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface StudioRepositoryContract
{
    public function findByStudioName($studioName): ?Model;

    public function createStudio($studioName): Model;
}
