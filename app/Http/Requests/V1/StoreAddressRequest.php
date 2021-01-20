<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAddressRequest extends FormRequest
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
            'address' => 'required|string',
            'country_id' => 'required',
            'city_id' => 'required',
            'post_code' => 'required',
            'floor' => 'required',
            'phone' => 'required'
        ];
    }

//    public function messages()
//    {
//        return [
//            'required' => 'Tələb olunan sahə.',
//            'string' => 'Format yalnız text(string) ola bilər.',
//        ];
//    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
