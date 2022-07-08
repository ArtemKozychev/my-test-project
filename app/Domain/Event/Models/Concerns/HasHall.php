<?php

namespace Domain\Event\Models\Concerns;

use Domain\Hall\Models\Hall;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasHall
{
    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }
}
