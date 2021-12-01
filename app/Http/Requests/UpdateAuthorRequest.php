<?php

namespace App\Http\Requests;

class UpdateAuthorRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'string|min:2|max:64',
            'rating' => 'integer|min:1|max:5'
        ];
    }
}
