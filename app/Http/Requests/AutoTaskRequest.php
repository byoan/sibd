<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AutoTaskRequest extends FormRequest
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
            'action' => 'required|string|max:50',
            'frequency' => 'required|integer|between:1,10',
            'idObject' => 'required|integer|min:1',
            'idUser' => 'required|integer|min:1'
        ];
    }
}
