<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'url' => 'required',
            #'icon' => 'required',
        ];
    }
}
