<?php

namespace App\Http\Requests\Api\Resturant;

use Illuminate\Foundation\Http\FormRequest;

class CreateOfferRequest extends FormRequest
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
            'resturant_id' => 'request()->user()->id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Name For the offer',
            'description.required' => 'Please Enter description For the offer',
            'image.required' => 'Please upload image For the offer',
            'start_at.required' => 'Please Enter start date For the offer',
            'end_at.required' => 'Please Enter end date For the offer',
        ];
    }
}
