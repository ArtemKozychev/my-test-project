<?php

namespace App\Http\Requests\Callboard;

use Domain\Callboard\Data\CallboardUpdateData;
use Illuminate\Foundation\Http\FormRequest;

class CallboardUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'is_publish' => ['required', 'boolean'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()?->id,
        ]);
    }

    public function data(): CallboardUpdateData
    {
        return (new CallboardUpdateData($this->validated()));
    }
}
