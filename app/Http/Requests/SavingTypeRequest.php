<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavingTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:saving_types,code,' . $this->saving_type?->id,
            'description' => 'nullable|string',
            'interest_rate' => 'required|numeric|min:0|max:100',
            'minimum_balance' => 'required|numeric|min:0',
            'is_mandatory' => 'boolean',
            'allow_withdrawal' => 'boolean',
            'withdrawal_restriction_days' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ];
    }
}
