@include('admin.developer.fields._input', [
    'label' => 'Slug',
    'id' => 'slug',
    'name' => 'slug',
    'required' => true,
    'value' => old('slug', $object->slug ?? null),
    'line' => true,
    'readOnly' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Име на общината [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][name]',
    'name' => 'i18n[' . $language->id . '][name]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.name', $i18n ? $i18n[$language->id]->name : ''),
    'line' => true,
])

@include('admin.developer.fields._textarea', [
    'label' => 'Описание [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][description]',
    'name' => 'i18n[' . $language->id . '][description]',
    'required' => true,
    'value' => old('i18n.' . $language->id . '.description', $i18n ? $i18n[$language->id]->description : ''),
    'line' => true,
    'editor' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Адрес [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][address]',
    'name' => 'i18n[' . $language->id . '][address]',
    'required' => true,
    'value' => old('i18n.' . $language->id . '.address', $i18n ? $i18n[$language->id]->address : ''),
    'hint' => 'Адрес на централата на общината',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Ключови думи [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][keywords]',
    'name' => 'i18n[' . $language->id . '][keywords]',
    'required' => true,
    'value' => old('i18n.' . $language->id . '.keywords', $i18n ? json_decode($i18n[$language->id]->keywords, true) : ''),
    'hint' => 'Ключови думи за SEO',
    'line' => true,
])
