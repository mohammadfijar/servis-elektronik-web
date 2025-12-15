<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string'],
            'telephone' => ['required', 'regex:/^[0-9\-\+]+$/'],
            'email'     => ['required', 'email', 'unique:customers,email'],
            'NIK'       => ['required', 'string', 'unique:customers,NIK'],
        ];
    }
}