<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required',
            'surname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'othername' => 'nullable|string|max:255',
            'gender' => 'nullable|in:male,female',
            'phone_number' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $this->member->id,
            'dob' => 'nullable|date',
            'state_id' => 'nullable|exists:states,id',
            'lga_id' => 'nullable|exists:lgas,id',
            'monthly_savings' => 'nullable|numeric|min:0',
            'share_subscription' => 'nullable|numeric|min:0',
            'date_join' => 'nullable|date'
        ];
    }
}
