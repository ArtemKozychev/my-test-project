<?php

namespace App\Http\Requests\Event;

use Domain\Event\Data\EventUpdateData;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
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
            'date_start' => ['required', 'date', 'unique:events,date_start'],
            'date_end' => ['required', 'date'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()?->id,
        ]);
    }

    public function data(): EventUpdateData
    {
        return (new EventUpdateData($this->validated()));
    }
}
