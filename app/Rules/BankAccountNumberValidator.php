<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BankAccountNumberValidator implements Rule
{
    /**
     * Validate that the value is a valid bank account number.
     *
     * @param  mixed  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Ensure it has the correct length (for example, between 9 and 18 digits)
        if (strlen($value) < 9 || strlen($value) > 18) {
            return false;
        }

        // Ensure it contains only digits
        if (!ctype_digit($value)) {
            return false;
        }

        // Optionally, add a checksum validation logic if applicable
        // This would require specific knowledge about the checksum algorithm used

        return true; // If all checks pass
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Bank account number must be a valid bank account number.';
    }
}