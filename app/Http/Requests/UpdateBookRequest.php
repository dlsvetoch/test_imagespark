<?php

namespace App\Http\Requests;

class UpdateBookRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'string|min:2|max:128',
            'author_id' => 'integer|exists:authors,id',
            'rating'    => 'integer|min:1|max:5'
        ];
    }
}
