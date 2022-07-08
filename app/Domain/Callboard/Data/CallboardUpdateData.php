<?php

namespace Domain\Callboard\Data;

use Spatie\DataTransferObject\DataTransferObject;

class CallboardUpdateData extends DataTransferObject
{
    public int $user_id;

    public string $name;

    public string $state;

    public string $is_publish;
}
