<?php

namespace App\Http\Requests\Api\Client;

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
            'name' => 'required',
            'email' => 'required|email|unique:clients',
            'image' => 'required',
            'phone' => 'required|unique:clients',
            'password' => 'required|confirmed',
            'neighbourhood_id' => 'required|exists:neighbourhood,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Name',
            'email.required' => 'Please Enter Your Email',
            'email.unique' => 'Sorry this Email Has An account',
            'image.required' => 'Please Enter Your image',
            'phone.required' => 'Please Enter Your Phone',
            'phone.unique' => 'Sorry this Phone Has An account',
            'password.required' => 'Please Enter Your Password',
            'password.confirmed' => 'Passwords Does not Match',
            'neighbourhood_id.required' => 'Please Choose Your Neighbourhood',
        ];
    }
}
