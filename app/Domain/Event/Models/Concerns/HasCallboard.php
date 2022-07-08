<?php

namespace Domain\Event\Models\Concerns;

use Domain\Callboard\Models\Callboard;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCallboard
{
    public function callboard(): BelongsTo
    {
        return $this->belongsTo(Callboard::class);
    }
}
