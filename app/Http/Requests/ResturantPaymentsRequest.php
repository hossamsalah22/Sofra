<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResturantPaymentsRequest extends FormRequest
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
            'paid' => 'required',
            'resturant_id' => 'required|exists:resturants,id',
            'payment_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'paid.required' => 'Paid Is Required',
            'resturant_id.required' => 'Resturant Is Required',
            'payment_date.required' => 'Payment Date Is Required',
        ];
    }
}
