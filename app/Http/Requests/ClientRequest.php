<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
                    'input-email' => 'required|email|min:5|max:50|unique:.users,email',
                    'input-company_name' => 'required|min:2|max:500',
                    'input-company_address' => 'required',
                    'input-company_phone' => 'required',
                    'input-is_active' => 'required',
                ];
            case "PUT":
                return [
                    'input-first_name' => 'required|min:2|max:50',
                    'input-last_name' => 'required|min:2|max:50',
                    'input-company_name' => 'required|min:2|max:500',
                    'input-company_address' => 'required|min:2|max:500',
                    'input-company_phone' => 'required|min:2|max:500',
                    'input-is_active' => 'required'
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
            'input-company_name' => 'İşletme Adı',
            'input-company_address' => 'İşletme Adresi',
            'input-company_phone' => 'Telefon Numarası',
            'input-is_active' => 'Durumu',
        ];
    }
}
