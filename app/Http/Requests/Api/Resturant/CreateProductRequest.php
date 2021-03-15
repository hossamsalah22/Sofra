<?php

namespace App\Http\Requests\Api\Resturant;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name' => 'required|unique:products',
            'ingredients' => 'required',
            'image' => 'required',
            'price' => 'required',
            'time_to_make' => 'required',
            'returant_id' => 'request()->user()->id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the name of the product',
            'ingredients.required' => 'Please enter the ingredients of the product',
            'image.required' => 'Please enter the image of the product',
            'price.required' => 'Please enter the price of the product',
            'time_to_make.required' => 'Please enter the Time required to make the product',
        ];
    }
}
