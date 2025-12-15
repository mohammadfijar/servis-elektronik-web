<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Only admin or owner can update services.
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
        $serviceId = $this->route('service')->id;

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