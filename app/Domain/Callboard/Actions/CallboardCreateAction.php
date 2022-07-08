<?php

namespace Domain\Callboard\Actions;

use Domain\Callboard\Data\CallboardCreateData;
use Domain\Callboard\Models\Callboard;

class CallboardCreateAction
{
    public function handle(CallboardCreateData $data): Callboard
    {
        return Callboard::create($data->toArray());
    }
}
