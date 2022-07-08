<?php

namespace App\Http\Requests\Subscription;

use Domain\Subscription\Data\SubscriptionData;
use Illuminate\Foundation\Http\FormRequest;

class SubscriptionCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'string', 'unique:subscribers,email'],
        ];
    }

    public function data(): SubscriptionData
    {
        return (new SubscriptionData($this->validated()));
    }
}
