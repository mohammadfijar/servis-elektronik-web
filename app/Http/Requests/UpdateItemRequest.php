<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Only admin or staff can update items.
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
        // Retrieve the current item id from route
        $itemId = $this->route('item')->id;

        return [
            'category_id'    => ['required', 'exists:categories,id'],
            'name'           => ['required', 'string', 'max:255', Rule::unique('items', 'name')->ignore($itemId)],
            'brand'          => ['required', 'string', 'max:255'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
            'selling_price'  => ['nullable', 'numeric', 'min:0'],
            'satuan_barang'  => ['required', Rule::in(['pcs','kg','ltr','pack','boks'])],
            'stock'          => ['required', 'integer', 'min:0'],
            'image'          => ['nullable', 'image', 'max:2048'],
        ];
    }
}
