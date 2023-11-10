<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\BaseRequest;

class AuthRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'min:5',
                'max:255',
            ],
        ];
    }
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('validation.required'),
            'email.email' => __('validation.email'),
            'email.max' => __('validation.max'),
            'password.required' => __('validation.required'),
            'password.min' => __('validation.min'),
            'password.max' => __('validation.max'),
        ];
    }
}
