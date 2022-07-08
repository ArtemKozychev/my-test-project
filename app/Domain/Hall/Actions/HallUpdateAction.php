<?php

namespace Domain\Hall\Actions;

use Domain\Hall\Data\HallUpdateData;
use Domain\Hall\Models\Hall;

class HallUpdateAction
{
    public function handle(Hall $hall, HallUpdateData $data): bool
    {
        return $hall->update($data->toArray());
    }
}
