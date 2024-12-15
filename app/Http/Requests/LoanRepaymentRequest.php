<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanRepaymentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $loan = $this->route('loan');
        $maxAmount = $loan->total_amount - $loan->paid_amount;

        return [
            'amount' => "required|numeric|min:0|max:$maxAmount",
            'payment_date' => 'required|date|before_or_equal:today',
            'payment_method' => 'required|in:bank_transfer,cash,cheque',
            'notes' => 'nullable|string|max:500'
        ];
    }
}
