<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TNDrivingLicenseValidator implements Rule
{
    /**
     * Validate that the value is a valid Tamil Nadu driving license.
     *
     * @param  mixed  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Basic pattern for Tamil Nadu driving license
        $pattern = '/^TN\d{2}[A-Z]?\d{11}$/';

        // Validate against the pattern
        if (!preg_match($pattern, $value)) {
            return false;
        }

        // Optionally, validate the RTO code if you have a list of valid codes
        // Example valid RTO codes
        // $validRTOCodes = ['01', '02', '03', '04', '05']; // (Extend this list with all valid RTO codes)

        // $rtoCode = substr($value, 3, 2);
        // if (!in_array($rtoCode, $validRTOCodes)) {
        //     return false;
        // }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The driving license must be a valid format.';
    }
}