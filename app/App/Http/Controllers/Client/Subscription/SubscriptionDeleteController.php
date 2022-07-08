<?php

namespace App\Http\Controllers\Client\Subscription;

use Domain\Subscription\Actions\SubscriptionDeleteAction;
use Domain\Subscription\Models\Subscribers;
use Illuminate\Http\JsonResponse;

class SubscriptionDeleteController
{
    public function __invoke(
        Subscribers              $subscribers,
        SubscriptionDeleteAction $action,
    ): JsonResponse
    {
        $action->handle($subscribers);

        return response()->json();
    }
}
