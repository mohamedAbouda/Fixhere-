<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
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
        $rid = request()->resource_id;
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$rid,
            'contact_number'=>'required',
            'location'=>'required',
            'profile_image'=>'nullable|image',
        ];
    }
}
