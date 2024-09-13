<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminAreasRequest extends AdminFormRequest
{
     public function rules()
    {
        $rules = [
            'i18n.1.name' => 'required|max:255',
            'i18n.1.description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'population' => 'required|numeric',
            'area' => 'required|numeric',
            
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'i18n.1.name' => 'Име на общината (bg)',
            'i18n.1.description' => 'Описание (bg)',
            'logo' => 'Главна снимка',
            'population' => 'Население',
            'area' => 'Площ',
        ];
    }
}