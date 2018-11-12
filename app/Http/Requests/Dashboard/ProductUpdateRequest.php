<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name' => 'required|min:1|max:190',
            'thumbnail' => 'nullable|image',
            'images.*' => 'image',
            'price' => 'required|min:0',
            'tech_fee' => 'required|min:0',
            'stock' => 'required|min:0',
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            // 'is_android_part' => 'required',
            // 'is_ios_part' => 'required',
            // 'is_delivery_part' => 'required',
        ];
    }
}
