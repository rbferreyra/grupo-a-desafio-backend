<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Foundation\Http\FormRequest as LaravelFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

abstract class FormRequest extends LaravelFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();


    protected function failedValidation(ValidationValidator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        $data = [
            'status' => JsonResponse::HTTP_UNPROCESSABLE_ENTITY,
            'success' => false,
            'errors' => $errors,
        ];

        throw new HttpResponseException(
            response()->json($data, JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
