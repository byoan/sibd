<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiseasesListRequest extends FormRequest
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
            'idHorse' => 'required|digits_between:1,7|exists:horses,id',
            'idDisease' => 'required|digits_between:1,7|exists:diseases,id',
        ];
    }
}
