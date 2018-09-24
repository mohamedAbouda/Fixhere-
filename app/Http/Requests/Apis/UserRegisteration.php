<?php

namespace App\Http\Requests\Apis;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisteration extends FormRequest
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
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'contact_number'=>'required',
            // 'location'=>'required',
            'profile_image'=>'nullable|image',
        ];
    }

    public function response(array $errors)
    {
        $validation_errors = [];
        foreach ($errors as $error) {
            $validation_errors[] = is_array($error) && $error ? $error[0] : $error;
        }

        return response()->json([
            'status' => 'false',
            'message' => 'error',
            'errors' => $validation_errors,
        ],422);
    }
}
