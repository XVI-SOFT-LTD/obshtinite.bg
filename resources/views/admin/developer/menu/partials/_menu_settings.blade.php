<div class="item-settings d-none form-horizontal form-label-left">
    @include('admin.developer.fields._input', [
        'label' => 'Заглавие',
        'id' => 'title',
        'name' => 'title',
        'required' => true,
    ])

    @include('admin.developer.fields._input', [
        'label' => 'Адрес (url)',
        'id' => 'url',
        'name' => 'url',
        'required' => true,
    ])

    @include('admin.developer.fields._input', [
        'label' => 'Иконка',
        'id' => 'icon',
        'name' => 'icon',
        'required' => false,
    ])

    <p>
        <a class="btn btn-danger item-delete" href="javascript:void(0);">Изтрий</a>
        <a class="btn btn-default item-close" href="javascript:void(0);">Затвори</a>
    </p>
</div>
