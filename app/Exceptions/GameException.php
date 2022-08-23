<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class GameException extends Exception
{
    public function render($e): JsonResponse
    {
        return response()->json([
            'error' => $this->getMessage()
        ]);
    }
}
