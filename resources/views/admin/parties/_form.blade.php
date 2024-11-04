@include('admin.developer.fields._input', [
    'label' => 'Телефон за контакт',
    'id' => 'contact_phone',
    'name' => 'contact_phone',
    'value' => old('contact_phone', $object->contact_phone ?? null),
    'hint' => 'Телефон за контакт с партията',
    'line' => true,
])

@include('admin.developer.fields._input', [
    'label' => 'Имейл за контакт',
    'id' => 'contact_email',
    'name' => 'contact_email',
    'value' => old('contact_email', $object->contact_email ?? null),
    'hint' => 'Имейл за контакт с партията',
    'line' => true,
])

@include('admin.developer.fields._number_input', [
    'label' => 'Брой места в парламента',
    'id' => 'seats_in_parliament',
    'name' => 'seats_in_parliament',
    'value' => old('seats_in_parliament', $object->seats_in_parliament ?? null),
    'hint' => 'Брой места, които партията заема в парламента',
    'line' => true,
])

@include('admin.developer.fields._date', [
    'label' => 'Дата на основаване',
    'id' => 'founding_date',
    'name' => 'founding_date',
    'value' => old(
        'founding_date',
        isset($object) && $object->founding_date ? date('d.m.Y H:i', strtotime($object->founding_date)) : null),
    'line' => true,
    'now' => true,
    'hint' => 'Дата на основаване на партията',
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Website',
    'id' => 'website',
    'name' => 'website',
    'value' => old('website', $object->website ?? null),
    'hint' => 'Сайт на партията',
    'line' => true,
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Facebook',
    'id' => 'social_media_facebook',
    'name' => 'social_media_links[facebook]',
    'value' => old('social_media_links.facebook', $object->social_media_links['facebook'] ?? ''),
    'hint' => 'Въведете URL адреса на вашата Facebook страница',
    'line' => true,
])

@include('admin.developer.fields._social_media_input', [
    'label' => 'Instagram',
    'id' => 'social_media_instagram',
    'name' => 'social_media_links[instagram]',
    'value' => old('social_media_links.instagram', $object->social_media_links['instagram'] ?? ''),
    'hint' => 'Въведете URL адреса на вашата Instagram страница',
    'line' => true,
])

@include('admin.developer.fields._image', [
    'label' => 'Главна снимка',
    'id' => 'logo',
    'name' => 'logo',
    'required' => false,
    'value' => old('logo', $object->logo ?? null),
    'line' => true,
    'hint' => 'Главна снимка на партията',
])

@include('admin.developer.fields._gallery', [
    'label' => 'Галерия',
    'id' => 'gallery',
    'name' => 'gallery',
    'required' => false,
    'line' => true,
    'hint' => 'Може да качите няколко изображения наведнъж',
])

@include('admin.developer.fields._textarea_autocomplete', [
    'label' => 'Коалиционни партии',
    'placeholder' => 'Изберете партии от списъка',
    'id' => 'autocomplete_parties',
    'name' => 'related_parties',
    'required' => false,
    'items' => $affiliatedParties,
    'selected' => $selectedAffiliatedParties,
    'line' => true,
    'multiple' => true,
])


@include('admin.developer.fields._checkbox', [
    'label' => 'Активна',
    'id' => 'active',
    'name' => 'active',
    'required' => false,
    'value' => old('active', $object->active ?? null),
    'checked' => old('active', $object->active ?? null) == '1' ? true : false,
    'line' => true,
    'hint' => 'Активирайте партията, за да бъде видима в сайта и за търсене',
])
