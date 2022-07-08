<?php

namespace Domain\User\Data;

use Spatie\DataTransferObject\DataTransferObject;

class UserUpdateData extends DataTransferObject
{
    public ?string $role;

    public ?string $name;

    public ?string $email;

    public ?string $password;
}
