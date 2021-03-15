<?php

namespace App\Http\Requests\Api\Resturant;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
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
            'name' => Rule::unique('products', 'name')
                ->ignore($this->user()->id),
            'returant_id' => 'request()->user()->id'
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'this product name already exists',
        ];
    }
}
