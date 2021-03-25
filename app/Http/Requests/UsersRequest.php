<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
            'name' => ['required', Rule::unique('users')->ignore($this->request->get('id'))],
            'email' => ['required', Rule::unique('users')->ignore($this->request->get('id'))],
            'password' => 'required|confirmed',
            'list_roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter Your Name',
            'name.unique' => 'This name Allready exists',
            'email.required' => 'Please Enter Your email',
            'email.unique' => 'This email Allready exists',
            'password.required' => 'Please Enter Your password',
            'password.confirmed' => 'password Does not match',
            'list_roles.required' => 'Chooose at least one role',
        ];
    }
}
