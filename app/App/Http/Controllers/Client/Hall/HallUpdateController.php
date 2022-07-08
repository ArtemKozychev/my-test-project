<?php

namespace App\Http\Controllers\Client\Hall;

use App\Http\Requests\Hall\HallUpdateRequest;
use Domain\Hall\Actions\HallUpdateAction;
use Domain\Hall\Models\Hall;
use Illuminate\Http\JsonResponse;

class HallUpdateController
{
    public function __invoke(
        Hall $hall,
        HallUpdateRequest $request,
        HallUpdateAction  $action,
    ): JsonResponse
    {
        $action->handle($hall, $request->data());

        return response()->json();
    }
}
