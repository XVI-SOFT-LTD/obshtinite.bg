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
    'label' => 'Име на пратията [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][name]',
    'name' => 'i18n[' . $language->id . '][name]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.name', $i18n ? $i18n[$language->id]->name : ''),
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Лидер на партията [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][leader_name]',
    'name' => 'i18n[' . $language->id . '][leader_name]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.leader_name', $i18n ? $i18n[$language->id]->leader_name : ''),
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Основател на партията [' . $language->code . ']',
    'id' => 'i18n[' . $language->id . '][founder_name]',
    'name' => 'i18n[' . $language->id . '][founder_name]',
    'required' => $language->id == 1 ? true : false,
    'class' => 'language-input',
    'value' => old('i18n.' . $language->id . '.founder_name', $i18n ? $i18n[$language->id]->founder_name : ''),
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
