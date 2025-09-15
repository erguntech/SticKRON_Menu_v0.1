<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemSettingsRequest extends FormRequest
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
                    'input-app_maintenance_mode' => 'required',
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'input-app_maintenance_mode' => 'Sistem Bakım Çalışması'
        ];
    }
}
