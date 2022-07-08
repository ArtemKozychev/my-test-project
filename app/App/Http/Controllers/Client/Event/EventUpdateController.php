<?php

namespace App\Http\Controllers\Client\Event;

use App\Http\Requests\Event\EventUpdateRequest;
use Domain\Event\Actions\EventUpdateAction;
use Domain\Event\Models\Event;
use Illuminate\Http\JsonResponse;

class EventUpdateController
{
    public function __invoke(
        Event $event,
        EventUpdateRequest $request,
        EventUpdateAction  $action,
    ): JsonResponse
    {
        $action->handle($event, $request->data());

        return response()->json();
    }
}
