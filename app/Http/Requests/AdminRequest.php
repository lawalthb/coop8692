<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [

            'surname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
          

        ];

        if ($this->isMethod('POST')) {
            $rules['email'] = 'required|string|email|max:255|unique:users';
            $rules['password'] = 'required|string|min:8|confirmed';
        } else {
            $rules['email'] = 'required|string|email|max:255|unique:users,email,' . $this->admin->id;
        }

        return $rules;
    }
}
