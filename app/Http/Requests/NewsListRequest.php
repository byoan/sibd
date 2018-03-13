<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsListRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'idNewspaper' => 'required|digits_between:1,7|exists:newspapers,id',
            'idNews' => 'required|digits_between:1,7|exists:news,id',
        ];
    }
}
