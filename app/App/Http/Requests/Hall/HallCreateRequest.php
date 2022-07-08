<?php

namespace App\Http\Requests\Hall;

use Domain\Hall\Data\HallCreateData;
use Illuminate\Foundation\Http\FormRequest;

class HallCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'number' => ['required', 'integer', 'unique:halls,number'],
            'seats' => ['required', 'integer'],
            'state' => ['required', 'string', 'max:255'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()?->id,
        ]);
    }

    public function data(): HallCreateData
    {
        return (new HallCreateData($this->validated()));
    }
}
