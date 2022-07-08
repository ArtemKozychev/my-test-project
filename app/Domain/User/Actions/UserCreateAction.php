<?php

namespace Domain\User\Actions;

use Domain\User\Data\UserCreateData;
use Domain\User\Models\User;

class UserCreateAction
{
    public function handle(UserCreateData $data): User
    {
        return User::create($data->toArray());
    }
}
