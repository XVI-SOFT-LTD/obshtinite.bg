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
                <label class="control-label col-md-12 col-sm-12 col-xs-12">Добави бутон</label>
            </div>
            <div class="form-group">
                <label for="new-field-name" class="control-label col-md-2 col-sm-2 col-xs-12">Име:</label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <input type="text" id="new-field-name" class="form-control col-md-7 col-xs-12" />
                </div>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <label for="new-field-active" class="control-label">Активен:</label>
                    <input type="checkbox" id="new-field-active" class="form-check-input" />
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <button type="button" id="add-field-button" class="btn btn-primary">Добави бутон</button>
                </div>
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
            const customTabsList = document.getElementById('custom-tabs-list');
            const customTabsContent = document.getElementById('custom-tabs-content');

            addFieldButton.addEventListener('click', function() {
                const fieldName = newFieldNameInput.value.trim();
                if (fieldName === '') {
                    alert('Моля, въведете име на полето.');
                    return;
                }

                const fieldIndex = customFieldsList.querySelectorAll('.custom-field').length;
                const slug = fieldName.toLowerCase().replace(/ /g, '-');

                // Add new field to the list
                const fieldHtml = `
                    <div class="tab-content">
                        <div class="col-md-2">
                            <label for="custom-fields[${fieldIndex}][slug]">Slug</label>
                            <input type="text" name="custom-fields[${fieldIndex}][slug]" class="form-control" value="${slug}" readonly />
                        </div>
                        <div class="col-md-2">
                            <label for="custom-fields[${fieldIndex}][name]">Име</label>
                            <input type="text" name="custom-fields[${fieldIndex}][name]" class="form-control" value="${fieldName}" readonly />

                        </div>
                             <label for="custom-fields[${fieldIndex}][active]">Активен:</label>
                            <input type="checkbox" name="custom-fields[${fieldIndex}][active]" />
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
                                <label for="description-${slug}">Описание</label>
                                <textarea id="description-${slug}" name="custom-fields[${fieldIndex}][description]" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="logo-${slug}">Главна снимка</label>
                                <input type="file" id="logo-${slug}" name="custom-fields[${fieldIndex}][logo]" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label for="gallery-${slug}">Галерия от снимки</label>
                                <input type="file" id="gallery-${slug}" name="custom-fields[${fieldIndex}][gallery][]" class="form-control" multiple />
                            </div>
                        </div>
                    `;
                    customTabsContent.insertAdjacentHTML('beforeend', tabContentHtml);
                } else {
                    console.error('Custom tab not found.');
                }

                newFieldNameInput.value = '';
            });
        });
    </script>
@endpush
