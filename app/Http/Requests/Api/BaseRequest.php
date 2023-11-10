<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class BaseRequest extends FormRequest
{
    /**
     * Summary of failedValidation
     * @param Validator $validator
     * @throws HttpResponseException
     * @return never
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response_error(['errors' => $validator->errors()], Response::HTTP_UNAUTHORIZED));
    }

    /**
     * Summary of failedAuthorization
     * @throws HttpResponseException
     * @return never
     */
    public function failedAuthorization()
    {
        throw new HttpResponseException(response_error(['errors' => ['error' => 'unAuthorized']], Response::HTTP_UNAUTHORIZED));
    }
}
