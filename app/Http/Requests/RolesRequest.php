<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RolesRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'name' => 'required|unique:roles,name,' . $request->segment(2),
            'permissions' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please Enter The Role name',
            'name.unique' => 'This role name allready exists',
            'permissions.required' => 'Please Choose at least one permission',
        ];
    }
}
