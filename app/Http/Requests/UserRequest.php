<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->getMethod()) {
            case "POST":
                return [
                    'input-first_name' => 'required|min:2|max:50',
                    'input-last_name' => 'required|min:2|max:50',
                    'input-email' => 'required|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                    'input-user_type' => 'required',
                    'input-is_active' => 'required',
                ];
            case "PUT":
                return [
                    'input-first_name' => 'required|min:2|max:50',
                    'input-last_name' => 'required|min:2|max:50',
                    'input-user_type' => 'required',
                    'input-is_active' => 'required',
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'input-first_name' => 'Adı',
            'input-last_name' => 'Soyadı',
            'input-email' => 'E-Posta Adresi',
            'input-user_type' => 'Kullanıcı Türü',
            'input-is_active' => 'Hesap Durumu',
        ];
    }
}
