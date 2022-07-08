<?php

namespace Domain\Hall\Data;

use Spatie\DataTransferObject\DataTransferObject;

class HallCreateData extends DataTransferObject
{
    public ?int $id;

    public int $user_id;

    public int $number;

    public int $seats;

    public string $state;
}
