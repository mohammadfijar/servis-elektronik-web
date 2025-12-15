<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Only admin or staff can create services.
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
            'item_id'        => ['required', 'exists:items,id'],
            'customer_id'    => ['nullable', 'exists:customers,id'],
            'description'    => ['required', 'string'],
            'diagnosis'      => ['nullable', 'string'],
            'action_taken'   => ['nullable', 'string'],
            'service_fee'    => ['required', 'numeric', 'min:0'],
            'service_date'   => ['required', 'date'],
            'status'         => ['required', Rule::in(['pending','in_progress','waiting_parts','completed','cancelled'])],
        ];
    }
}