<?php

namespace App\Rules;

use App\User;
use App\Models\store;
use Illuminate\Contracts\Validation\Rule;

class UniquePhone implements Rule
{
    protected $id;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check users table
        $userExists = User::where('id', '!=', $this->id)->where('phone', $value)->exists();

        // Check stores table (mobile_number column)
        $storeMobileNumberExists = Store::where('user_id', '!=', $this->id)
            ->where('mobile_number', $value)->exists();

        // Return false if the value exists in any of the checked columns
        return !($userExists || $storeMobileNumberExists);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Mobile or phone number already exist.';
    }
}
