<?php

namespace App\Http\Controllers\Client\Event;

use App\Http\Requests\Event\EventCreateRequest;
use Domain\Event\Actions\EventCreateAction;
use Illuminate\Http\JsonResponse;

class EventCreateController
{
    public function __invoke(
        EventCreateRequest $request,
        EventCreateAction  $action,
    ): JsonResponse
    {
        $action->handle($request->data());

        return response()->json();
    }
}
