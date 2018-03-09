<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopRequest extends FormRequest
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
            'horseList' =>'required|string',
            'itemList' =>'required|string',
            'infraList' =>'required|string',
            'ridingStableList' =>'required|string',
            'horseClubList' =>'required|string'
        ];
    }
}
