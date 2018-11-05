<?php

namespace App\Http\Requests;


class UrlRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|url',
        ];
    }
}
