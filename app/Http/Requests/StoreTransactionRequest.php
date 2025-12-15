<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Only admin, staff, or kasir roles can create transactions.
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
        return [
            'invoice_no'     => ['required', 'string', 'max:50', 'unique:transactions,invoice_no'],
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
