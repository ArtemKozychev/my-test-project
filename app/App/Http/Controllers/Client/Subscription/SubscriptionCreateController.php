<?php

namespace App\Http\Controllers\Client\Subscription;

use App\Http\Requests\Subscription\SubscriptionCreateRequest;
use Domain\Subscription\Actions\SubscriptionCreateAction;
use Domain\Subscription\Models\Subscribers;
use Illuminate\Http\JsonResponse;

class SubscriptionCreateController
{
    public function __invoke(
        SubscriptionCreateRequest $request,
        SubscriptionCreateAction  $action,
    ): JsonResponse
    {
        $action->handle($request->data());

        return response()->json();
    }
}
