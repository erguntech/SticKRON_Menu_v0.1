<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DigitalMenuCampaignRequest extends FormRequest
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
                    'input-campaign_name' => 'required|min:2|max:500',
                    'input-campaign_standard_price' => 'required|numeric|min:0|max:500000',
                    'input-campaign_discounted_price' => 'required|numeric|min:0|max:500000',
                    'input-campaign_main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                    'input-is_active' => 'required',
                ];
            case "PUT":
                return [
                    'input-campaign_name' => 'required|min:2|max:500',
                    'input-campaign_standard_price' => 'required|numeric|min:0|max:500000',
                    'input-campaign_discounted_price' => 'required|numeric|min:0|max:500000',
                    'input-campaign_main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
                    'input-is_active' => 'required'
                ];
            default:
                return [];
        }
    }

    public function attributes()
    {
        return [
            'input-campaign_name' => 'Kampanya Adı',
            'input-campaign_description' => 'Kampanya Açıklaması',
            'input-campaign_standard_price' => 'Kampanya Normal Fiyatı',
            'input-campaign_discounted_price' => 'Kampanya İndirimli Fiyatı',
            'input-campaign_main_image' => 'Kampanya Manşet Resmi',
            'input-is_active' => 'Durumu',
        ];
    }
}
