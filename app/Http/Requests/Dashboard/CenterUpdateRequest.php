<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CenterUpdateRequest extends FormRequest
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
            'password'=>'confirmed',

            'contact_number'=>'required',
            'location'=>'required',
            'lat'=>'required',
            'lng'=>'required',
            'cost_per_hour'=>'min:0',
            'cover_image'=>'nullable|image',
        ];
    }
}
