@include('admin.developer.fields._input', [
    'label' => 'Име на категория [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][name]',
    'name' => 'i18n[' . $language->id . '][name]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.name', $i18n ? $i18n[$language->id]->name : ''),
])

@include('admin.developer.fields._textarea', [
    'label' => 'Описание [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][description]',
    'name' => 'i18n[' . $language->id . '][description]',
    'required' => false,
    'value' => old('i18n.' . $language->id . '.description', $i18n ? $i18n[$language->id]->description : ''),
    'line' => false,
    'editor' => false,
])
