<?php

namespace App\Http\Controllers\Client\Hall;

use Domain\Hall\Actions\HallDeleteAction;
use Domain\Hall\Models\Hall;
use Illuminate\Http\JsonResponse;

class HallDeleteController
{
    public function __invoke(
        Hall $hall,
        HallDeleteAction  $action,
    ): JsonResponse
    {
        $action->handle($hall);

        return response()->json();
    }
}
