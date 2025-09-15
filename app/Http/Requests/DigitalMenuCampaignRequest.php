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
                    'input-campaign_price' => 'required|min:2|max:500',
                    'input-is_active' => 'required',
                ];
            case "PUT":
                return [
                    'input-campaign_name' => 'required|min:2|max:500',
                    'input-campaign_price' => 'required|min:2|max:500',
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
            'input-campaign_price' => 'Kampanya Fiyatı',
            'input-is_active' => 'Durumu',
        ];
    }
}
