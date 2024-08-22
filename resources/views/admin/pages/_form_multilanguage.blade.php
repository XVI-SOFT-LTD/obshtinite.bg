@include('admin.developer.fields._input', [
    'label' => 'Име на страница [' . $language->code . ']',
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
    'line' => false,
    'editor' => true,
])
