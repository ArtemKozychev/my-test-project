<?php

namespace App\Rules;

use Domain\Event\Models\Event;
use Domain\Hall\Models\Hall;
use Illuminate\Contracts\Validation\Rule;

class DateIsNotInEventPeriod implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {

        $eventCount = Event::query()
            ->whereDateInEventPeriod($value)
            ->count();

        $hallCount = Hall::count();

        return $eventCount < $hallCount;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'There is already an event for this date.';
    }
}
