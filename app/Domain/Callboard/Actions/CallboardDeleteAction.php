<?php

namespace Domain\Callboard\Actions;

use Domain\Callboard\Models\Callboard;

class CallboardDeleteAction
{
    public function handle(Callboard $callboard): bool
    {
        return $callboard->delete();
    }
}
