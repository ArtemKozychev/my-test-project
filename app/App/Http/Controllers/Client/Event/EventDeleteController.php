<?php

namespace App\Http\Controllers\Client\Event;

use Domain\Event\Actions\EventDeleteAction;
use Domain\Event\Models\Event;
use Illuminate\Http\JsonResponse;

class EventDeleteController
{
    public function __invoke(
        Event $event,
        EventDeleteAction  $action,
    ): JsonResponse
    {
        $action->handle($event);

        return response()->json();
    }
}
