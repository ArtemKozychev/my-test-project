<?php

namespace Domain\User\Actions;

use Domain\User\Models\User;

class UserDeleteAction
{
    public function handle(User $user): bool
    {
        return $user->delete();
    }
}
