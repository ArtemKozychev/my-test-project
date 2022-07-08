<?php

namespace Domain\Callboard\Actions;

use Domain\Callboard\Data\CallboardUpdateData;
use Domain\Callboard\Events\CallboardPublishedEvent;
use Domain\Callboard\Models\Callboard;

class CallboardUpdateAction
{
    public function handle(
        Callboard           $callboard,
        CallboardUpdateData $data,
    ): Callboard
    {
        $callboard->update($data->toArray());

        $this->fireEvents($callboard);

        return $callboard;
    }

    private function fireEvents(Callboard $callboard)
    {
        if ($callboard->wasChanged('is_publish') && $callboard->is_publish) {
            event(new CallboardPublishedEvent($callboard));
        }
    }
}
