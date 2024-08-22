<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Admin\AdminFormRequest;

class AdminPageRequest extends AdminFormRequest
{
    public function rules()
    {
        $rules = [
            'i18n.1.title' => 'required|max:255',
            'i18n.1.description' => 'required',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'i18n.1.title' => 'Заглавие на книга (bg)',
            'i18n.1.description' => 'Описание (bg)',
        ];
    }

}
