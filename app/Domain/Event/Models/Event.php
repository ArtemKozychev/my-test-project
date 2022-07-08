<?php

namespace Domain\Event\Models;

use Domain\Event\Models\Concerns\HasCallboard;
use Domain\Event\Queries\EventQueryBuilder;
use Domain\Event\Models\Concerns\HasHall;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use HasHall;
    use HasCallboard;

    protected $guarded = [];

    protected $dates = [
        'date_start',
        'date_end'
    ];

    public function newEloquentBuilder($query): EventQueryBuilder
    {
        return new EventQueryBuilder($query);
    }
}
