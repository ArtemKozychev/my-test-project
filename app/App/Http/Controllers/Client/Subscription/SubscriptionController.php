<?php

namespace App\Http\Controllers\Client\Subscription;

use App\Http\Resources\Subscription\SubscriptionListResource;
use Domain\Subscription\Models\Subscribers;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SubscriptionController
{
    public function __invoke(
        Subscribers $subscribers,
    ): ResourceCollection
    {
        return SubscriptionListResource::collection(
            $subscribers->order('created_at', 'desc')
                ->paginate(),
        );
    }
}
