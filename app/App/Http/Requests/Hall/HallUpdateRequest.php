<?php

namespace App\Http\Requests\Hall;

use Domain\Hall\Data\HallUpdateData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HallUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'number' => [
                'required',
                'integer',
                Rule::unique('halls', 'number')->ignore($this->hall->id)
            ],
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

    public function data(): HallUpdateData
    {
        return (new HallUpdateData($this->validated()));
    }
}
