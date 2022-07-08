<?php

namespace Domain\User\Data;

use DateTime;
use Spatie\DataTransferObject\DataTransferObject;

class UserCreateData extends DataTransferObject
{
    public ?int $id;

    public ?string $role;

    public ?string $name;

    public ?string $email;

    public ?string $password;
}
