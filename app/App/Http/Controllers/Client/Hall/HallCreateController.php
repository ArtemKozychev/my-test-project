<?php

namespace App\Http\Controllers\Client\Hall;

use App\Http\Requests\Hall\HallCreateRequest;
use Domain\Hall\Actions\HallCreateAction;
use Illuminate\Http\JsonResponse;

class HallCreateController
{
    public function __invoke(
        HallCreateRequest $request,
        HallCreateAction  $action,
    ): JsonResponse
    {
        $action->handle($request->data());

        return response()->json();
    }
}
