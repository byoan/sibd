<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemFamilyRequest extends FormRequest
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
            'familyName' => 'required|string|max:191',
            'description' => 'required|string'
        ];
    }
}
