<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminNewsRequest extends AdminFormRequest
{
    public function rules()
    {
        $rules = [
            'i18n.1.title' => 'required|max:255',
            'i18n.1.description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'categories' => 'required|array',
            'authors' => 'required|array',
            'related_news' => 'array',
            'municipality_id' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'i18n.1.title' => 'Заглавие на книга (bg)',
            'i18n.1.description' => 'Описание (bg)',
            'logo' => 'Главна снимка',
            'categories' => 'Категории',
            'authors' => 'Автори',
            'related_news' => 'Свързани новини',
            'municipality_id' => 'Община',
        ];
    }

}