<?php

namespace Domain\Hall\Actions;

use Domain\Hall\Data\HallCreateData;
use Domain\Hall\Models\Hall;

class HallCreateAction
{
    public function handle(HallCreateData $data): Hall
    {
        return Hall::create($data->toArray());
    }
}
