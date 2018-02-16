<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfrastructureRequest extends FormRequest
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
            'family' => 'required|string|max:191',
            'price' => 'required|numeric|between:1.00,99.999',
            'ressourcesConsumption' => 'required|string|max:191',
            'itemCapacity' => 'required|integer|max:100',
            'horseCapacity' => 'required|integer|max:100',
            'itemList' => 'required|string',
        ];
    }
}
