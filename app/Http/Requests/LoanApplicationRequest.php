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
            'duration' => 'required|integer|min:4|max:18',
            'purpose' => 'required|string|max:1000',
            'guarantors' => 'required|array|min:0',
            'guarantors.*' => 'required|exists:users,id|different:user_id',

        ];
    }

    public function messages()
    {
        return [
            'guarantors.required' => 'At least one guarantor is required',
            'guarantors.array' => 'Guarantors must be selected properly',
            'guarantors.*.exists' => 'Selected guarantor is invalid',
            'guarantors.*.different' => 'You cannot select yourself as a guarantor',
        ];
    }


}
