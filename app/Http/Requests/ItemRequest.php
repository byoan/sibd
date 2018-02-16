<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'type' => 'required|string|max:191',
            'level' => 'required|integer|between:1,100',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0.0,99.999',
            'family' => 'required|string|max:191'
        ];
    }
}
