<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrderUpdateRequest extends FormRequest
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
            'service_type' => 'required',
            'center_id' => 'nullable|exists:users,id',
            'agent_id' => 'required|exists:users,id',
            'client_id' => 'required|exists:users,id',
            'order_date' => 'required|date',
            'time_from' => 'required|date_format:"H:i"',
            'time_to' => 'required|date_format:"H:i"',
            'lat'=>'required',
            'lng'=>'required',
            'problem'=>'required',
        ];
    }
}
