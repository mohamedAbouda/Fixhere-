<?php

namespace App\Http\Requests\Apis;

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
        $rid = request()->user()->id;
        return [
            'email'=>'unique:users,email,'.$rid,
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
