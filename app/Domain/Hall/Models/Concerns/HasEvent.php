<?php

namespace Domain\Hall\Models\Concerns;

use Domain\Event\Models\Event;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasEvent
{
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
