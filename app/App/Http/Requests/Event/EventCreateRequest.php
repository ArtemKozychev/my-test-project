<?php

namespace App\Http\Requests\Event;

use App\Rules\DateIsNotInEventPeriod;
use Domain\Event\Data\EventCreateData;
use Illuminate\Foundation\Http\FormRequest;

class EventCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'callboard_id' => ['required', 'exists:callboards,id'],
            'hall_id' => ['required', 'exists:halls,id'],
            'name' => ['required', 'string', 'max:255'],
            'date_start' => ['required', 'date', new DateIsNotInEventPeriod],
            'date_end' => ['required', 'date', new DateIsNotInEventPeriod],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()?->id,
        ]);
    }

    public function data(): EventCreateData
    {
        return (new EventCreateData($this->validated()));
    }
}
