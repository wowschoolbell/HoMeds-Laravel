<?php

namespace App\Rules;

use App\Models\DeliveryPartner;
use App\Models\store;

use Illuminate\Contracts\Validation\Rule;

class BankAccountNumberValidator implements Rule
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
     * Validate that the value is a valid bank account number.
     *
     * @param  mixed  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        // Check stores table (bank_account_number column)
        $storeBankNumberExists = Store::where('user_id', '!=', $this->id)
            ->where('bank_account_number', $value)->exists();

        // Check stores table (bank_account_number column)
        $deliveryBankNumberExists = DeliveryPartner::where('user_id', '!=', $this->id)
            ->where('bank_acc_number', $value)->exists();

        // Return false if the value exists in any of the checked columns
        return !($storeBankNumberExists || $deliveryBankNumberExists);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Bank account number already exist.';
    }
}