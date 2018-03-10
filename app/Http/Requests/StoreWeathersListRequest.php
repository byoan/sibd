<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWeathersListRequest extends FormRequest
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
            'idNewspaper' => 'required|digits_between:1,7|unique:weather_lists|exists:newspapers,id',
            'idWeather' => 'required|digits_between:1,7|unique:weather_lists|exists:weathers,id'
        ];
    }
}
