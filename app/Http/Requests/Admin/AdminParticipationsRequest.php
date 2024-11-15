<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminParticipationsRequest extends AdminFormRequest
{
    public function rules()
    {
        $rules = [
            'i18n.1.name' => 'required|max:255',
            'i18n.1.description' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'contact_phone_one' => 'required|regex:/^[+]?[(]?[0-9]{1,4}[)]?[-\s\.\/0-9]*$/',
            'contact_phone_two' => 'nullable|regex:/^[+]?[(]?[0-9]{1,4}[)]?[-\s\.\/0-9]*$/',
            'contact_email' => 'required|email',
            'i18n.1.address' => 'required|max:255',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'working_hours' => 'required',
            'active_from' => 'required',
            'active_to' => 'required',
            'i18n.1.keywords' => 'required',
            'position' => 'nullable|numeric',
            'area_id' => 'required',
            'categories' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'i18n.1.name' => 'Име на общината (bg)',
            'i18n.1.description' => 'Описание (bg)',
            'logo' => 'Главна снимка',
            'contact_phone_one' => 'Телефон за контакт 1',
            'contact_phone_two' => 'Телефон за контакт 2',
            'contact_email' => 'Имейл за контакт',
            'i18n.1.address' => 'Адрес (bg)',
            'longitude' => 'Географска Дължина',
            'latitude' => 'Географска Ширина',
            'working_hours' => 'Работно време',
            'active_from' => 'Активна от',
            'active_to' => 'Активна до',
            'social_media_links' => 'Социални медии',
            'i18n.1.keywords' => 'Ключови думи (bg)',
            'position' => 'Позиция',
            'area_id' => 'Област',
            'categories' => 'Категории',
        ];
    }
}