<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'loan_type_id' => 'required|exists:loan_types,id',
            'amount' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:6|max:18',
            'purpose' => 'required|string|max:1000'
        ];
    }
}
