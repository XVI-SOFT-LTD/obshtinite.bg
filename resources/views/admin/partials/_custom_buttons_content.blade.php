<input type="hidden" name="delete_gallery_images" id="delete-gallery-images" value="">
<input type="hidden" name="delete_buttons" id="delete-buttons" value="">
<div class="tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul class="nav nav-tabs bar_tabs" role="tablist" id="custom-tabs-list">
        <li role="tab-custom" class="nav-item">
            <a href="#tab-custom" role="tab" data-toggle="tab">
                Показване / Скриване на бутони
            </a>
        </li>
        @foreach ($customButtons as $button)
            <li role="tab-{{ $button->slug }}" class="nav-item">
                <a href="#tab-{{ $button->slug }}" role="tab" data-toggle="tab">
                    {{ $button->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>

<div class="tab-content" id="custom-tabs-content">
    <div role="tabpanel" class="tab-pane fade in active" id="tab-custom" aria-labelledby="tab-custom">
        <div id="custom-buttons-list" class="custom-buttons-grid">
            @foreach ($customButtons as $button)
                <div class="custom-field form-group" data-index="{{ $loop->index }}">
                    <input type="hidden" name="customButtons[{{ $loop->index }}][id]" value="{{ $button->id }}">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="customButtons[{{ $loop->index }}][slug]" class="control-label">Slug</label>
                        </div>
                        <div class="col-md-2">
                            <label for="customButtons[{{ $loop->index }}][name]" class="control-label">Име</label>
                        </div>
                        <div class="col-md-2">
                            <label for="customButtons[{{ $loop->index }}][active]"
                                class="control-label">Активен</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="text" name="customButtons[{{ $loop->index }}][slug]" class="form-control"
                                value="{{ $button->slug }}" readonly />
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="customButtons[{{ $loop->index }}][name]" class="form-control"
                                value="{{ $button->name }}" readonly />
                        </div>
                        <div class="col-md-1">
                            <input type="checkbox" name="customButtons[{{ $loop->index }}][active]"
                                class="form-check-input" {{ $button->active ? 'checked' : '' }} />
                        </div>
                        <div>
                            <button type="button" class="btn btn-primary btn-sm edit-button"
                                data-index="{{ $loop->index }}">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-danger btn-sm remove-button"
                                data-index="{{ $loop->index }}">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <hr>

        <div id="custom-buttons-container" class="custom-buttons-grid">
            <div class="row">
                <div class="col-md-2">
                    <label for="new-field-name" class="control-label">Име</label>
                </div>
                <div class="col-md-1">
                    <label for="new-field-active" class="control-label">Активен:</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <input type="text" id="new-field-name" class="form-control" />
                    <div id="name-error" class="text-danger" style="display: none;">Моля, въведете име</div>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="new-field-active" class="form-check-input" />
                </div>
                <div class="col-md-2">
                    <button type="button" id="add-field-button" class="btn btn-primary">Добави бутон</button>
                </div>
            </div>
        </div>
    </div>
    @foreach ($customButtons as $button)
        <div role="tabpanel" class="tab-pane fade" id="tab-{{ $button->slug }}"
            aria-labelledby="tab-{{ $button->slug }}">
            <div class="form-group row">
                <label for="description-{{ $button->slug }}"
                    class="control-label col-md-3 col-sm-3 col-xs-12">Описание</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <textarea id="description-{{ $button->slug }}" name="customButtons[{{ $loop->index }}][description]"
                        class="form-control">{{ $button->description }}</textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="logo-{{ $button->slug }}" class="control-label col-md-3 col-sm-3 col-xs-12">Главна
                    снимка</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="file" id="logo-{{ $button->slug }}"
                        name="customButtons[{{ $loop->index }}][logo]" class="form-control" />
                    @if ($button->logo)
                        <img src="{{ asset($button->getDir() . $size . $button->logo) }}" alt="{{ $button->name }}"
                            class="img-thumbnail" style="max-height: 100px;">
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="gallery-{{ $button->slug }}" class="control-label col-md-3 col-sm-3 col-xs-12">Галерия от
                    снимки</label>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <input type="file" id="gallery-{{ $button->slug }}"
                        name="customButtons[{{ $loop->index }}][gallery][]" class="form-control" multiple />
                    @if ($button->gallery)
                        @foreach ($button->gallery as $image)
                            <div class="gallery-image-wrapper"
                                style="position: relative; display: inline-block; margin: 5px;">
                                <img src="{{ asset($image->getImage()) }}" alt="{{ $button->name }}"
                                    class="img-thumbnail" style="max-height: 100px;">
                                <button type="button" class="btn btn-danger btn-sm remove-gallery-image"
                                    data-image-id="{{ $image->id }}"
                                    style="position: absolute; top: 0; right: 0; padding: 2px 5px;">&times;</button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</div>

<style>
    .custom-buttons-grid .row {
        display: flex;
        align-items: center;
        margin-block: 10px;
    }

    .is-invalid {
        border-color: red;
    }
</style>

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const addFieldButton = document.getElementById('add-field-button');
            const customFieldsList = document.getElementById('custom-buttons-list');
            const newFieldNameInput = document.getElementById('new-field-name');
            const newFieldActiveCheckbox = document.getElementById('new-field-active');
            const customTabsList = document.getElementById('custom-tabs-list');
            const customTabsContent = document.getElementById('custom-tabs-content');

            addFieldButton.addEventListener('click', function() {
                const fieldName = newFieldNameInput.value.trim();
                const fieldActive = newFieldActiveCheckbox.checked;
                const nameError = document.getElementById('name-error');

                if (fieldName === '') {
                    newFieldNameInput.classList.add('is-invalid');
                    nameError.style.display = 'block';
                    return;
                } else {
                    newFieldNameInput.classList.remove('is-invalid');
                    nameError.style.display = 'none';
                }

                const editIndex = addFieldButton.getAttribute('data-edit-index');
                if (editIndex !== null) {
                    // Update existing field
                    const field = customFieldsList.querySelector(
                        `.custom-field[data-index="${editIndex}"]`);
                    const fieldNameInput = field.querySelector(
                        `input[name="customButtons[${editIndex}][name]"]`);
                    const fieldActiveCheckbox = field.querySelector(
                        `input[name="customButtons[${editIndex}][active]"]`);
                    const fieldSlugInput = field.querySelector(
                        `input[name="customButtons[${editIndex}][slug]"]`);

                    const oldSlug = fieldSlugInput.value;
                    const newSlug = fieldName.toLowerCase().replace(/ /g, '-');

                    fieldNameInput.value = fieldName;
                    fieldActiveCheckbox.checked = fieldActive;
                    fieldSlugInput.value = newSlug;

                    // Update tab name and id
                    const tab = customTabsList.querySelector(`li[role="tab-${oldSlug}"] a`);
                    if (tab) {
                        tab.textContent = fieldName;
                        tab.parentElement.setAttribute('role', `tab-${newSlug}`);
                        tab.setAttribute('href', `#tab-${newSlug}`);
                        tab.setAttribute('aria-labelledby', `tab-${newSlug}`);
                    }

                    const tabContent = customTabsContent.querySelector(`#tab-${oldSlug}`);
                    if (tabContent) {
                        tabContent.setAttribute('id', `tab-${newSlug}`);
                        tabContent.setAttribute('aria-labelledby', `tab-${newSlug}`);
                    }

                    addFieldButton.textContent = 'Добави бутон';
                    addFieldButton.removeAttribute('data-edit-index');
                } else {
                    // Add new field
                    const fieldIndex = customFieldsList.querySelectorAll('.custom-field').length;
                    const slug = fieldName.toLowerCase().replace(/ /g, '-');

                    const fieldHtml = `
                        <div class="custom-field form-group" data-index="${fieldIndex}">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="customButtons[${fieldIndex}][slug]" class="control-label">Slug</label>
                                </div>
                                <div class="col-md-2">
                                    <label for="customButtons[${fieldIndex}][name]" class="control-label">Име</label>
                                </div>
                                <div class="col-md-1">
                                    <label for="customButtons[${fieldIndex}][active]" class="control-label">Активен</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="text" name="customButtons[${fieldIndex}][slug]" class="form-control" value="${slug}" readonly />
                                </div>
                                <div class="col-md-2">
                                    <input type="text" name="customButtons[${fieldIndex}][name]" class="form-control" value="${fieldName}" readonly />
                                </div>
                                <div class="col-md-1">
                                    <input type="checkbox" name="customButtons[${fieldIndex}][active]" class="form-check-input" ${fieldActive ? 'checked' : 'unchecked'} />
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm edit-button" data-index="${fieldIndex}">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-danger btn-sm remove-button" data-index="${fieldIndex}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    customFieldsList.insertAdjacentHTML('beforeend', fieldHtml);

                    const customTab = document.querySelector('li[role="tab-custom"]');
                    if (customTab) {
                        const tabHtml = `
                            <li role="tab-${slug}" class="nav-item">
                                <a href="#tab-${slug}" role="tab" data-toggle="tab" aria-expanded="false">
                                    ${fieldName}
                                </a>
                            </li>
                        `;
                        customTab.insertAdjacentHTML('afterend', tabHtml);

                        const tabContentHtml = `
                            <div role="tabpanel" class="tab-pane fade" id="tab-${slug}" aria-labelledby="tab-${slug}">
                                <div class="form-group row">
                                    <label for="description-${slug}" class="control-label col-md-3 col-sm-3 col-xs-12">Описание</label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <textarea id="description-${slug}" name="customButtons[${fieldIndex}][description]" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo-${slug}" class="control-label col-md-3 col-sm-3 col-xs-12">Главна снимка</label>
                                    <div class="col-md-2 col-sm-7 col-xs-12">
                                        <input type="file" id="logo-${slug}" name="customButtons[${fieldIndex}][logo]" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="gallery-${slug}" class="control-label col-md-3 col-sm-3 col-xs-12">Галерия от снимки</label>
                                    <div class="col-md-7 col-sm-7 col-xs-12">
                                        <input type="file" id="gallery-${slug}" name="customButtons[${fieldIndex}][gallery][]" class="form-control" multiple />
                                    </div>
                                </div>
                            </div>
                        `;
                        customTabsContent.insertAdjacentHTML('beforeend', tabContentHtml);
                    } else {
                        console.error('Custom tab not found.');
                    }
                }

                newFieldNameInput.value = '';
                newFieldActiveCheckbox.checked = false;
            });

            document.addEventListener('click', function(event) {
                const target = event.target.closest('button');
                if (!target) return;

                if (target.classList.contains('edit-button')) {
                    const index = target.getAttribute('data-index');
                    const field = customFieldsList.querySelector(`.custom-field[data-index="${index}"]`);
                    const fieldNameInput = field.querySelector(
                        `input[name="customButtons[${index}][name]"]`);
                    const fieldActiveCheckbox = field.querySelector(
                        `input[name="customButtons[${index}][active]"]`);

                    newFieldNameInput.value = fieldNameInput.value;
                    newFieldActiveCheckbox.checked = fieldActiveCheckbox.checked;

                    addFieldButton.textContent = 'Запази промените';
                    addFieldButton.setAttribute('data-edit-index', index);
                }
                if (target.classList.contains('remove-button')) {
                    const index = target.getAttribute('data-index');
                    const field = customFieldsList.querySelector(`.custom-field[data-index="${index}"]`);
                    const buttonIdInput = field.querySelector(`input[name="customButtons[${index}][id]"]`);
                    const deleteButtonsInput = document.getElementById('delete-buttons');

                    if (buttonIdInput) {
                        const buttonId = buttonIdInput.value;
                        if (deleteButtonsInput.value) {
                            deleteButtonsInput.value += `,${buttonId}`;
                        } else {
                            deleteButtonsInput.value = buttonId;
                        }
                    }

                    // Remove field
                    field.remove();

                    // Remove tab
                    const slug = field.querySelector(`input[name="customButtons[${index}][slug]"]`).value;
                    const tab = customTabsList.querySelector(`li[role="tab-${slug}"]`);
                    if (tab) {
                        tab.remove();
                    }

                    // Remove tab content
                    const tabContent = customTabsContent.querySelector(`#tab-${slug}`);
                    if (tabContent) {
                        tabContent.remove();
                    }

                    // Update data-index attributes
                    const fields = customFieldsList.querySelectorAll('.custom-field');
                    fields.forEach((field, idx) => {
                        field.setAttribute('data-index', idx);
                        field.querySelectorAll('input, button').forEach(input => {
                            const name = input.getAttribute('name');
                            if (name) {
                                input.setAttribute('name', name.replace(/\[\d+\]/, `[${idx}]`));
                            }
                            const dataIndex = input.getAttribute('data-index');
                            if (dataIndex !== null) {
                                input.setAttribute('data-index', idx);
                            }
                        });
                    });
                }

                if (target.classList.contains('remove-gallery-image')) {
                    const imageId = target.getAttribute('data-image-id');
                    const imageWrapper = target.closest('.gallery-image-wrapper');
                    const deleteGalleryImagesInput = document.getElementById('delete-gallery-images');

                    if (deleteGalleryImagesInput) {
                        deleteGalleryImagesInput.value += `,${imageId}`;
                    } else {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'delete_gallery_images';
                        input.value = imageId;
                        document.querySelector('form').appendChild(input);
                    }

                    imageWrapper.remove();
                }
            });
        });
    </script>
@endpush
