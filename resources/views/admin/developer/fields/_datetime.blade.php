<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>

        {{ $label }}

        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="form-group">
            <div class='input-group date datetimepicker' style="margin-bottom: 1px;">
                <input type="text" id="datetimepicker-{{ $name }}" class="form-control" name="{{ $name }}" value="{{ old($name, $value ?? '') }}" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>
            @isset($hint)
                <small class="form-text text-muted">{{ $hint }}</small>
            @endisset
        </div>
    </div>
</div>

@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif

@push('js-init')
    <script type="text/javascript">
        $(function() {
            var $datetimepicker = $('#datetimepicker-{{ $name }}').datetimepicker({
                locale: 'bg',
                format: 'DD.MM.YYYY HH:mm',
                defaultDate: @if (@$value)
                    moment('{{ $value }}', 'DD.MM.YYYY HH:mm')
                @else
                    moment()
                @endif ,
            });

            $datetimepicker.find('input').on('focus', function() {
                $datetimepicker.datetimepicker('show');
            });
        });
    </script>
@endpush
