<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoanTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'required_active_savings_months' => 'required|integer|min:0',
            'savings_multiplier' => 'required|numeric|min:0',
            'interest_rate' => 'required|numeric|min:0|max:100',
           
            'max_duration_months' => 'required|integer|min:1|max:18',
            'minimum_amount' => 'required|numeric|min:0',
            'maximum_amount' => 'required|numeric|gt:minimum_amount',
            'allow_early_payment' => 'boolean',
            'saved_percentage' => 'nullable|in:50,100,150,200,250,300,None',
            'no_guarantors' => 'required|integer|min:0',
            'status' => 'sometimes|in:active,inactive'
        ];
    }
}
