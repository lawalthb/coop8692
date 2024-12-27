<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavingEntryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'saving_type_id' => 'required|exists:saving_types,id',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date|before_or_equal:today',
           
        ];
    }
}
