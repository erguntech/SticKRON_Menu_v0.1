<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return match ($this->getMethod()) {
            "POST" => [
                'input-message_content' => 'required|min:2|max:500000'
            ],
            default => [],
        };
    }

    public function attributes()
    {
        return [
            'input-message_content' => 'Mesajınız'
        ];
    }
}
