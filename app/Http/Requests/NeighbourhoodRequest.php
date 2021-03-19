<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NeighbourhoodRequest extends FormRequest
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
            'city_id' => 'required|exists:cities,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter Neighbourhood Name',
            'city_id.required' => 'please choose the city'
        ];
    }
}
