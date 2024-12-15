<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|in:Mr.,Mrs.,Ms.,Dr.,Prof.,Engr.,Arc.,Pst.,Rev.',
            'phone_number' => 'required|string|max:20',
            'dob' => 'nullable|date',
            'home_address' => 'nullable|string|max:500',
            'nok' => 'nullable|string|max:255',
            'nok_relationship' => 'nullable|string|max:100',
            'nok_phone' => 'nullable|string|max:20',
            'nok_address' => 'nullable|string|max:500',
            'member_image' => 'nullable|image|max:2048',
            'signature_image' => 'nullable|image|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'member_image.max' => 'The profile picture must not exceed 2MB.',
            'signature_image.max' => 'The signature image must not exceed 2MB.',
        ];
    }
}
