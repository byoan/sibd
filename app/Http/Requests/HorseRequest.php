<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'race' => 'required|string|max:191',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0.0,99.999',
            'experience' => 'required|integer|between:0,1000',
            'level' => 'required|integer|between:0,100',
            'generalLevel' => 'required|integer|between:0,100',
        ];
    }
}