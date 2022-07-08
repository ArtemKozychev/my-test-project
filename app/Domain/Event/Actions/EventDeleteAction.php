<?php

namespace Domain\Event\Actions;

use Domain\Event\Models\Event;

class EventDeleteAction
{
    public function handle(Event $event): bool
    {
        return $event->delete();
    }
}
