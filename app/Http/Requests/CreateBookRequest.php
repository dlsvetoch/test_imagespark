<?php

namespace App\Http\Requests;

class CreateBookRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'     => 'required|string|min:2|max:128',
            'author_id' => 'required|integer|exists:authors,id',
            'rating'    => 'prohibited',
        ];
    }
}
