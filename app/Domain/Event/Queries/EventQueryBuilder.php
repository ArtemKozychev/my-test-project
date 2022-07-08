<?php

namespace Domain\Event\Queries;

use Illuminate\Database\Eloquent\Builder;

class EventQueryBuilder extends Builder
{
    public function whereDateInEventPeriod($date): self
    {
        return $this
            ->where('date_start', '<=', $date)
            ->where('date_end', '>=', $date);
    }
}
