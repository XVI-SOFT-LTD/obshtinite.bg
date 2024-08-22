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
    'label' => 'Заглавие [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][title]',
    'name' => 'i18n[' . $language->id . '][title]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.title', $i18n ? $i18n[$language->id]->title : ''),
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
