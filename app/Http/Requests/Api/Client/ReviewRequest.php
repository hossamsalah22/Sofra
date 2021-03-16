<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'rate' => 'required',
            'resturant_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'rate.required' => 'please choose your rate for the restaurant',
            'restaurant_id.required' => 'please Enter restaurant',
        ];
    }
}
