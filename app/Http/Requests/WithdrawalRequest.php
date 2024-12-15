<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\SavingType;

class WithdrawalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'saving_type_id' => 'required|exists:saving_types,id',
            'amount' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) {
                    $savingType = SavingType::find($this->saving_type_id);
                    $userBalance = auth()->user()->getBalanceForSavingType($this->saving_type_id);

                    if ($value > $userBalance) {
                        $fail('Insufficient balance for withdrawal.');
                    }

                    if ($userBalance - $value < $savingType->minimum_balance) {
                        $fail('Withdrawal would put your balance below the minimum required balance.');
                    }
                },
            ],
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',
            'account_name' => 'required|string|max:255',
            'reason' => 'required|string|max:500'
        ];
    }
}
