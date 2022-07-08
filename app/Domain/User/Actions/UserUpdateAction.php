<?php

namespace Domain\User\Actions;

use Domain\User\Data\UserUpdateData;
use Domain\User\Models\User;

class UserUpdateAction
{
    public function handle(User $user, UserUpdateData $data): bool
    {
        return $user->update($data->toArray());
    }
}
