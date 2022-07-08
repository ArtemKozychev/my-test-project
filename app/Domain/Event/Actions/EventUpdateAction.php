<?php

namespace Domain\Event\Actions;

use Domain\Event\Data\EventUpdateData;
use Domain\Event\Models\Event;

class EventUpdateAction
{
    public function handle(Event $event, EventUpdateData $data): bool
    {
        return $event->update($data->toArray());
    }
}
