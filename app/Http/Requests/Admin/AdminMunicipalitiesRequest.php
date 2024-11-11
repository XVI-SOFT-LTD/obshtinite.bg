<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminMunicipalitiesRequest extends AdminFormRequest
{
    public function rules()
    {
        // dd($this->all());
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
            'active_from' => 'required',
            'active_to' => 'required',
            'i18n.1.keywords' => 'required',
            'position' => 'nullable|numeric',
            'area_id' => 'required',
        ];

         // Add validation rules for custom fields
        foreach ($this->input('custom-button', []) as $index => $field) {
            $rules["custom-button.$index.name"] = 'string|max:255';
            $rules["custom-button.$index.slug"] = 'string|max:255';
            $rules["custom-button.$index.active"] = 'in:on,off';
            $rules["custom-button.$index.description"] = 'nullable|string';
            $rules["custom-button.$index.logo"] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096';
            $rules["custom-button.$index.gallery"] = 'nullable|array';
            $rules["custom-button.$index.gallery.*"] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096';
        }

            return $rules;
        }

    public function attributes()
    {
         $attributes = [
        'i18n.1.name' => 'Име на общината (bg)',
        'i18n.1.description' => 'Описание (bg)',
        'logo' => 'Главна снимка',
        'contact_phone_one' => 'Телефон за контакт 1',
        'contact_phone_two' => 'Телефон за контакт 2',
        'contact_email' => 'Имейл за контакт',
        'i18n.1.address' => 'Адрес (bg)',
        'longitude' => 'Географска Дължина',
        'latitude' => 'Географска Ширина',
        'active_from' => 'Активна от',
        'active_to' => 'Активна до',
        'social_media_links' => 'Социални медии',
        'i18n.1.keywords' => 'Ключови думи (bg)',
        'position' => 'Позиция',
        'area_id' => 'Област',
        ];
        
        // // Add attributes for custom fields
        // foreach ($this->input('custom-button', []) as $index => $field) {
        //     $attributes["custom-button.$index.name"] = "Име на бутон $index";
        //     $attributes["custom-button.$index.slug"] = "Slug на бутон $index";
        //     $attributes["custom-button.$index.active"] = "Активен бутон $index";
        //     $attributes["custom-button.$index.description"] = "Описание на бутон $index";
        //     $attributes["custom-button.$index.logo"] = "Лого на бутон $index";
        //     $attributes["custom-button.$index.gallery"] = "Галерия на бутон $index";
        // }

        return $attributes;
    }
}