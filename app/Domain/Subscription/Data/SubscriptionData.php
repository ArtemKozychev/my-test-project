<?php

namespace Domain\Subscription\Data;

use Spatie\DataTransferObject\DataTransferObject;

class SubscriptionData extends DataTransferObject
{
    public string $email;
}
