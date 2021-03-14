<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
            'pin_code' => 'required',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'pin_code.required' => 'Please enter the code sent to your email',
            'password.required' => 'please enter the new password',
            'password.confirmed' => 'password does not match',
        ];
    }
}
