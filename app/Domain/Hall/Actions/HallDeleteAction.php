<?php

namespace Domain\Hall\Actions;

use Domain\Hall\Models\Hall;

class HallDeleteAction
{
    public function handle(Hall $hall): bool
    {
        return $hall->delete();
    }
}
