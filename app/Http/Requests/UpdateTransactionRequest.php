<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Only admin or owner can update transactions.
     */
    public function authorize()
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $transactionId = $this->route('transaction')->id;

        return [
            'invoice_no'     => [
                'required', 'string', 'max:50',
                Rule::unique('transactions','invoice_no')->ignore($transactionId)
            ],
            'customer_id'    => ['nullable', 'exists:customers,id'],
            'paid'           => ['required', 'numeric', 'min:0'],
            'discount'       => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['required', Rule::in(['cash', 'card', 'transfer', 'ewallet'])],
            'lines'          => ['required', 'array', 'min:1'],
            'lines.*.type'   => ['required', Rule::in(['item', 'service'])],
            'lines.*.id'     => ['required', 'integer'],
            'lines.*.quantity'=> ['required', 'integer', 'min:1'],
            'lines.*.price'  => ['required', 'numeric', 'min:0'],
        ];
    }
}

