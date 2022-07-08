<?php

namespace Domain\Subscription\Actions;

use Domain\Subscription\Data\SubscriptionData;
use Domain\Subscription\Models\Subscribers;

class SubscriptionCreateAction
{
    public function handle(
        SubscriptionData $data
    ): int
    {
        $model = new Subscribers;

        if ($model->whereEmail($data->email)->doesntExist()) {
            $model->create($data->toArray());
        }

        return $model->count();
    }
}
