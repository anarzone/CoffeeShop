<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminUserRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required|unique:customers,id,'.$this->request->get('user_id'),
            'email' => 'required|email|unique:users,email,'.$this->request->get('user_id'),
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Tələb olunan sahə.',
            'email' => 'Mail formatı yalnışdır.',
            'string' => 'Format yalnız text(string) ola bilər.',
            'unique' => 'Artıq istifadə edilib.',
            'confirmed' => 'Şifrənin təsdiqi yalnışdır'
        ];
    }
}
