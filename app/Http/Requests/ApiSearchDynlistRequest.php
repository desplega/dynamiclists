<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApiSearchDynlistRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'list' => 'required|max:100',
            'field' => 'required|max:100',
            'value' => 'required|max:100',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response([
            'result' => 'error',
            'message' => 'Non valid parameters',
            'errors' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }
}
