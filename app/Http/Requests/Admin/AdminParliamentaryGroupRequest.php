<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminParliamentaryGroupRequest extends AdminFormRequest
{
    public function rules()
    {
        $rules = [
            'i18n.1.name' => 'required|max:255',
            'i18n.1.leader_name' => 'required|max:255',
            'i18n.1.founder_name' => 'required|max:255',
            'i18n.1.description' => 'required',
            'contact_phone' => 'required|max:255',
            'contact_email' => 'email',
            'founding_date' => 'required|date',
            'social_media_links' => 'array',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'i18n.1.headquarters_address' => 'required|max:255',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'i18n.1.name' => 'Име на партията (bg)',
            'i18n.1.leader_name' => 'Лидер на партията (bg)',
            'i18n.1.founder_name' => 'Основател на партията (bg)',
            'i18n.1.description' => 'Описание (bg)',
            'contact_phone' => 'Телефон',
            'contact_email' => 'Имейл',
            'founding_date' => 'Дата на основаване',
            'social_media_links' => 'Социални мрежи',
            'logo' => 'Главна снимка',
            'headquarters_address' => 'Адрес на централата',
        ];
    }

}