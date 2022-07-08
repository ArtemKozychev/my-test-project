<?php

namespace Domain\Subscription\Actions;

use Domain\Subscription\Models\Subscribers;

class SubscriptionDeleteAction
{
    public function handle(
        Subscribers $subscribers,
    ): int
    {
        $model = $subscribers;
        $model->delete();

        return $model->count();
    }
}
