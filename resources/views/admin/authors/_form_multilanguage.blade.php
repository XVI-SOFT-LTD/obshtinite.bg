@include('admin.developer.fields._input', [
    'label' => 'Име на автор [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][fullname]',
    'name' => 'i18n[' . $language->id . '][fullname]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.fullname', $i18n ? $i18n[$language->id]->fullname : ''),
])

@include('admin.developer.fields._textarea', [
    'label' => 'Описание [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][description]',
    'name' => 'i18n[' . $language->id . '][description]',
    'required' => false,
    'value' => old('i18n.' . $language->id . '.description', $i18n ? $i18n[$language->id]->description : ''),
    'line' => false,
    'editor' => true,
])
