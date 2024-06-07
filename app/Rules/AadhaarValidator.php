<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AadhaarValidator implements Rule
{
    /**
     * Validate that the value is a valid Aadhaar number.
     *
     * @param  mixed  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if it's 12 digits long
        if (strlen(str_replace(' ', '', $value)) !== 12) {
            return false;
        }

        // Check if it's all digits
        if (!ctype_digit(str_replace(' ', '', $value))) {
            return false;
        }

        // Check if it's not all zeros
        if ($value === str_repeat('0', 12)) {
            return false;
        }

        // Optionally, implement checksum validation (like Verhoeff algorithm)
        // If you do, return false if the checksum doesn't pass
        
        return true; // Assuming simple checks passed
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Aadhaar number must be a valid.';
    }
}