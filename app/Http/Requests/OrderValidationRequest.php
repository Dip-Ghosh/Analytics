<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderValidationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'start_date' => 'required',
            'end_date'   => 'required',
        ];
    }

    public function messages()
    {
        return [
            'start_date.required' => 'Start Date should be given',
            'end_date.required'   => 'End Date should be given',
        ];
    }
}
