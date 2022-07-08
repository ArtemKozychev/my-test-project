<?php

namespace App\Http\Resources\Subscription;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionListResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'email' => $this->email,
        ];
    }
}
