<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class AgentUpdateRequest extends FormRequest
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
        $rid = request()->get('resource_id');
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email,' . $rid,
            'password'=>'nullable|confirmed',
            'profile_image'=>'nullable|image',
            'parent_id' => 'required|exists:users,id'
        ];
    }
}
