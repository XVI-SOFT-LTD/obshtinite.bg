<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminLandmarksRequest extends FormRequest
{
     public function rules()
    {
        $rules = [
            'i18n.1.name' => 'required|max:255',
            'i18n.1.description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'working_hours' => 'required',
            'municipality_id' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'i18n.1.name' => 'Име на общината (bg)',
            'i18n.1.description' => 'Описание (bg)',
            'logo' => 'Главна снимка',
            'longitude' => 'Географска Дължина',
            'latitude' => 'Географска Ширина',
            'working_hours' => 'Работно време',
            'municipality_id' => 'Община',
        ];
    }
    
}