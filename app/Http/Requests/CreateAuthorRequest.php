<?php

namespace App\Http\Requests;

class CreateAuthorRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|string|min:2|max:64',
            'rating' => 'prohibited',
        ];
    }
}
