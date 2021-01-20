<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|array',
            'description' => 'required|array',
            'description.*.*' => 'required',
            'sku' => 'required',
            'variants' => 'required|array',
            'variants.*.quantity' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'brand_id' => 'required',
            'product_type_id' => 'required',
            'image_ids' => 'required',
            'main_image' => $this->request->has('main_image') ? 'required' : 'nullable',
            'categories' => 'required|array'
        ];
    }
}
