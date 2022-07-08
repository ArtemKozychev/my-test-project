<?php

namespace Domain\Hall\Data;

use Spatie\DataTransferObject\DataTransferObject;

class HallUpdateData extends DataTransferObject
{
    public int $user_id;

    public int $number;

    public int $seats;

    public string $state;
}
