<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AgentCreateRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed',
            'profile_image'=>'required|image',
            'parent_id' => 'required|exists:users,id'
        ];
    }
}
