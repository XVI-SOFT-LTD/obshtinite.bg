@include('admin.developer.fields._input', [
    'label' => 'Име [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][name]',
    'name' => 'i18n[' . $language->id . '][name]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.name', $i18n ? $i18n[$language->id]->name : ''),
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Ключови думи [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][keywords]',
    'name' => 'i18n[' . $language->id . '][keywords]',
    'required' => true,
    'value' => old('i18n.' . $language->id . '.keywords', $i18n ? $i18n[$language->id]->keywords : ''),
    'hint' => 'Ключови думи за SEO',
    'line' => true,
])
