<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        $customerId = $this->route('customer')->id;

        return [
            'name'      => ['required', 'string', 'max:255'],
            'address'   => ['required', 'string'],
            'telephone' => ['required', 'regex:/^[0-9\-\+]+$/'],
            'email'     => ['required', 'email', Rule::unique('customers','email')->ignore($customerId)],
            'NIK'       => ['required', 'string', Rule::unique('customers','NIK')->ignore($customerId)],
        ];
    }
}
