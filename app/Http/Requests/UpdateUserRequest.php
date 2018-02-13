<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|alpha_num|max:20',
            'firstName' => 'required|string|max:20',
            'lastName' => 'required|string|max:20',
            'email' => 'required|email',
            'description' => 'required|string|max:200',
            'role' => 'required|digits:1',
            'sex' => 'required|alpha|max:1',
            'birthDate' => 'required|date',
            'address' => 'alpha_num|max:100',
            'phone' => 'digits:10',
            'website' => 'url',
        ];
    }
}
