<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name' => 'required|string',
            'slug' => 'required|string|unique:brands,id,'.$this->request->get('brand_id'),
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Tələb olunan sahə.',
            'string' => 'Format yalnız text(string) ola bilər.',
            'unique' => 'Artıq istifadə edilib.',
        ];
    }
}
