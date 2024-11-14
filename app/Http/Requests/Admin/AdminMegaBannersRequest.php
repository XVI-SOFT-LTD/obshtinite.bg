<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminMegaBannersRequest extends AdminFormRequest
{
    public function rules()
    {
        $rules = [
            'i18n.1.name' => 'required|max:255',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'active_from' => 'required',
            'active_to' => 'required',
        ];

            return $rules;
        }

    public function attributes()
    {
         $attributes = [
        'i18n.1.name' => 'Име на общината (bg)',
        'logo' => 'Главна снимка',
        'active_from' => 'Активна от',
        'active_to' => 'Активна до',
        ];

        return $attributes;
    }
}