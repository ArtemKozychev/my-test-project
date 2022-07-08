<?php

namespace Domain\Event\Actions;

use Domain\Event\Data\EventCreateData;
use Domain\Event\Models\Event;

class EventCreateAction
{
    public function handle(EventCreateData $data): Event
    {
        return Event::create($data->toArray());
    }
}
