<?php

namespace App\Http\Requests\Api\Resturant;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|unique:resturants',
            'email' => 'required|email|unique:resturants',
            'phone' => 'required|unique:resturants',
            'password' => 'required|confirmed',
            'image' => 'required',
            'delivery' => 'required',
            'min_charge' => 'required',
            'status' => 'required',
            'whats_num' => 'required',
            'resturant_phone' => 'required',
            'neighbourhood_id' => 'required|exists:neighbourhood,id',
            'categories' => 'required|array|exists:categories,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Name',
            'name.unique' => 'Sorry this name already exists',
            'email.required' => 'Please Enter Your Email',
            'email.unique' => 'Sorry this Email Has An account',
            'phone.required' => 'Please Enter Your Phone',
            'phone.unique' => 'Sorry this Phone Has An account',
            'password.required' => 'Please Enter Your Password',
            'password.confirmed' => 'Passwords Does not Match',
            'neighbourhood_id.required' => 'Please Choose Your Neighbourhood',
            'image.required' => 'Please Enter Your photo',
            'delivery.required' => 'Please Enter Your Delivery Fees',
            'min_charge.required' => 'Please Enter Your Minimum Charge',
            'status.required' => 'Please Choose Your Status',
            'whats_num.required' => 'Please Enter Your Whatsapp Number',
            'resturant_phone.required' => 'Please Enter The resturant number',
            'categories.required' => 'please choose at least one category',
        ];
    }
}
