<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorseClubRequest extends FormRequest
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
            'capacity' => 'required|integer|between:1,100',
            'infraList' => 'required|string|max:500',
            'contestList' => 'required|string|max:500',
            'userList' => 'required|string|max:500',
            'idUser' => 'required|integer|exists:users,id'
        ];
    }
}
