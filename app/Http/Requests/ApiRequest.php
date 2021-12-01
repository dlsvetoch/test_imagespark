<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @param Validator $validator
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $messages = $validator->errors()->getMessages();

        $result = [
            'status' => 'Failed',
        ];

        foreach ($messages as $key => $message) {
            $result['data'][$key] = array_shift($message);
        }

        throw new HttpResponseException(response()->json($result, 422));
    }
}
