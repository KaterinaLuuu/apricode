<?php

namespace App\Contracts;

interface StudioRepositoryContract
{
    public function getOrCreateStudio($studio);
}
