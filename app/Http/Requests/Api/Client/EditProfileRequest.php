<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProfileRequest extends FormRequest
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
            'email' => Rule::unique('clients', 'email')->ignore($this->user()->id),
            'phone' => Rule::unique('clients', 'phone')->ignore($this->user()->id),
            'password' => 'confirmed',
            'neighbourhood_id' => 'exists:neighbourhood,id',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'Sorry this Email Has An account',
            'phone.unique' => 'Sorry this Phone Has An account',
            'password.confirmed' => 'Passwords Does not Match',
        ];
    }
}
