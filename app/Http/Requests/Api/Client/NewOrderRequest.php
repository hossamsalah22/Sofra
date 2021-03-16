<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Foundation\Http\FormRequest;

class NewOrderRequest extends FormRequest
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
            'payment_method_id' => 'required|exists:payment_methods,id',
            'address' => 'required',
            'product.*.product_id' => 'required|exists:products,id',
            'product.*.quantity' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'payment_method_id.required' => 'please Choose Your Payment Methd',
            'address.required' => 'please Enter your Address',
            'product_id.required' => 'please Choose at least one product',
            'quantity.required' => 'please Choose quantity',
        ];
    }
}
