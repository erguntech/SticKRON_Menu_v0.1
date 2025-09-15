<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DigitalMenuCategoryRequest extends FormRequest
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
                    'input-category_name' => 'required|min:2|max:500',
                    'input-is_active' => 'required',
                ];
            case "PUT":
                return [
                    'input-category_name' => 'required|min:2|max:500',
                    'input-is_active' => 'required'
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'input-category_name' => 'Kategori Adı',
            'input-category_description' => 'Kategori Açıklaması',
            'input-is_active' => 'Durumu',
        ];
    }
}
