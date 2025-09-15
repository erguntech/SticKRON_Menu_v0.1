<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DigitalMenuContentRequest extends FormRequest
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
                    'input-content_name' => 'required|min:2|max:500',
                    'input-content_price' => 'required|min:2|max:500',
                    'input-digital_menu_category_id' => 'required',
                    'input-product_main_image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
                    'input-is_active' => 'required',
                ];
            case "PUT":
                return [
                    'input-content_name' => 'required|min:2|max:500',
                    'input-content_price' => 'required|min:2|max:500',
                    'input-digital_menu_category_id' => 'required',
                    'input-product_main_image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
                    'input-is_active' => 'required'
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'input-content_name' => 'Ürün Adı',
            'input-content_description' => 'Ürün Açıklaması',
            'input-content_price' => 'Ürün Fiyatı',
            'input-product_main_image' => 'Ürün Manşet Resmi',
            'input-digital_menu_category_id' => 'Kategori Seçimi',
            'input-is_active' => 'Durumu',
        ];
    }
}
