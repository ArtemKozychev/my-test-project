<?php

namespace Domain\Event\Data;

use Carbon\Carbon;
use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class EventUpdateData extends DataTransferObject
{
    public int $callboard_id;

    public int $hall_id;

    public ?string $name;

    public ?DateTime $date_start;

    public ?DateTime $date_end;

    public function __construct(array $parameters = [])
    {
        if (isset($parameters['date_start'])) {
            $parameters['date_start'] = Carbon::parse($parameters['date_start']);
        }

        if (isset($parameters['date_end'])) {
            $parameters['date_end'] = Carbon::parse($parameters['date_end']);
        }

        parent::__construct($parameters);
    }
}
