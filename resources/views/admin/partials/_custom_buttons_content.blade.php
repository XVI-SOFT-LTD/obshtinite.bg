<div class="tabs" role="tabpanel" data-example-id="togglable-tabs">
    <ul class="nav nav-tabs bar_tabs" role="tablist" id="custom-tabs-list">
        <li role="tab-custom" class="nav-item">
            <a href="#tab-custom" role="tab" data-toggle="tab" aria-expanded="false">
                Показване / Скриване на бутони
            </a>
        </li>
    </ul>
</div>

<div class="tab-content" id="custom-tabs-content">
    <div role="tabpanel" class="tab-pane fade" id="tab-custom" aria-labelledby="tab-custom">
        <div id="custom-fields-list"></div>
        <div id="custom-fields-container">
            <div class="form-group">
                <label class="control-label">Добави бутон</label>
            </div>
            <div class="form-group">
                <label for="new-field-name" class="control-label col-md-1 col-sm-1 col-xs-1">Име:</label>
                <div class="col-sm-2">
                    <input type="text" id="new-field-name" class="form-control" />
                </div>
                <div class="form-group row">
                    <div class="control-label col-md-1 col-sm-1 col-xs-1">
                        <label for="new-field-active">Активен:</label>
                        <input type="checkbox" id="new-field-active" class="form-check-input" />
                    </div>
                </div>
            </div>
            <div class="control-label col-md-1 col-sm-1 col-xs-1">
                <button type="button" id="add-field-button" class="btn btn-primary ">Добави бутон</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            const addFieldButton = document.getElementById('add-field-button');
            const customFieldsList = document.getElementById('custom-fields-list');
            const newFieldNameInput = document.getElementById('new-field-name');
            const newFieldActiveCheckbox = document.getElementById('new-field-active');
            const customTabsList = document.getElementById('custom-tabs-list');
            const customTabsContent = document.getElementById('custom-tabs-content');

            addFieldButton.addEventListener('click', function() {
                const fieldName = newFieldNameInput.value.trim();
                const fieldActive = newFieldActiveCheckbox.checked;
                if (fieldName === '') {
                    alert('Моля, въведете име на полето.');
                    return;
                }

                const fieldIndex = customFieldsList.querySelectorAll('.custom-field').length;
                const slug = fieldName.toLowerCase().replace(/ /g, '-');

                // Add new field to the list
                const fieldHtml = `
                    <div class="custom-field form-group row">
                        <div class="col-md-2">
                            <label for="custom-fields[${fieldIndex}][slug]" class="control-label">Slug</label>
                            <input type="text" name="custom-fields[${fieldIndex}][slug]" class="form-control" value="${slug}" readonly />
                        </div>
                        <div class="col-md-2">
                            <label for="custom-fields[${fieldIndex}][name]" class="control-label">Име</label>
                            <input type="text" name="custom-fields[${fieldIndex}][name]" class="form-control" value="${fieldName}" readonly />
                        </div>
                        <div class="col-md-2">
                            <label for="custom-fields[${fieldIndex}][active]" class="control-label">Активен:</label>
                            <input type="checkbox" name="custom-fields[${fieldIndex}][active]" class="form-check-input" ${fieldActive ? 'checked' : ''} />
                        </div>
                    </div>
                `;
                customFieldsList.insertAdjacentHTML('beforeend', fieldHtml);

                // Add new tab after Custom tab
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

                    // Add new tab content
                    const tabContentHtml = `
                        <div role="tabpanel" class="tab-pane fade" id="tab-${slug}" aria-labelledby="tab-${slug}">
                            <div class="form-group">
                                <label for="description-${slug}" class="control-label col-md-3 col-sm-3 col-xs-12">Описание</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <textarea id="description-${slug}" name="custom-fields[${fieldIndex}][description]" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="logo-${slug}" class="control-label col-md-3 col-sm-3 col-xs-12">Главна снимка</label>
                                <div class="col-md-2 col-sm-7 col-xs-12">
                                    <input type="file" id="logo-${slug}" name="custom-fields[${fieldIndex}][logo]" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gallery-${slug}" class="control-label col-md-3 col-sm-3 col-xs-12">Галерия от снимки</label>
                                <div class="col-md-7 col-sm-7 col-xs-12">
                                    <input type="file" id="gallery-${slug}" name="custom-fields[${fieldIndex}][gallery][]" class="form-control" multiple />
                                </div>
                            </div>
                        </div>
                    `;
                    customTabsContent.insertAdjacentHTML('beforeend', tabContentHtml);
                } else {
                    console.error('Custom tab not found.');
                }

                newFieldNameInput.value = '';
                newFieldActiveCheckbox.checked = false;
            });
        });
    </script>
@endpush
