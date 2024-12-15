<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BulkSavingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'transaction_date' => 'required|date|before_or_equal:today',
            'entries' => 'required|array|min:1',
            'entries.*.user_id' => 'required|exists:users,id',
            'entries.*.saving_type_id' => 'required|exists:saving_types,id',
            'entries.*.amount' => 'required|numeric|min:0'
        ];
    }
}
