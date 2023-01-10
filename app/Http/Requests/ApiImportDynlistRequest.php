<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class ApiImportDynlistRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'csvfile' => 'required|file|mimes:csv,txt|max:2048',
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
