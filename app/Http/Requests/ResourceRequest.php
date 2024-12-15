<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResourceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'file.max' => 'The file size must not exceed 10MB.',
            'file.mimes' => 'The file must be a PDF, Word document, Excel spreadsheet, or image.'
        ];
    }
}
