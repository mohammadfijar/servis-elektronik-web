<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Ubah jika diperlukan otorisasi
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'roles'    => 'required|array',
            'roles.*'  => 'exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama wajib diisi',
            'email.required'    => 'Email wajib diisi',
            'email.email'       => 'Format email tidak valid',
            'email.unique'      => 'Email sudah digunakan',
            'password.min'      => 'Password minimal 6 karakter',
            'password.confirmed'=> 'Konfirmasi password tidak cocok',
            'roles.required'    => 'Pilih minimal satu role',
            'roles.*.exists'    => 'Role tidak valid',
        ];
    }
}
