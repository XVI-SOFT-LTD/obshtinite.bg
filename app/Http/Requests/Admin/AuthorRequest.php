<?php

namespace App\Http\Requests\Admin;

use Intervention\Image\ImageManager;
use Intervention\Image\Image;
use App\Http\Requests\Admin\AdminFormRequest;

class AuthorRequest extends AdminFormRequest
{
    public function rules()
    {
        return [
            #'i18n.*.fullname' => 'required|max:255',
            'i18n.1.fullname' => 'required|max:255',
            'active' => 'required|boolean',
            'logo' => [
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:4096',
                function ($attribute, $value, $fail) {
                    $image = ImageManager::gd()->read($value->getPathname());
                    if ($image->width() < 358 || $image->height() < 500) {
                        #return $fail('Снимка на автора трябва да е минимум 358x500 пиксела.');
                    }
                },
            ],
            #'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096|dimensions:min_width=358,min_height=500,max_width=1000,max_height=1000',
        ];
    }

    public function attributes()
    {
        return [
            'i18n.1.fullname' => 'Име на автор (bg)',
            'i18n.2.fullname' => 'Име на автор (en)',
            'logo' => 'Снимка на автора',
        ];
    }

    public function messages()
    {
        return [
            'logo.min' => 'Снимката на автора',
        ];
    }
}
