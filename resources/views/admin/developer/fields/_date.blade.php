<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" @isset($id) for="{{ $id }}" @endisset>

        {{ $label }}

        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
    </label>
    <div class="col-md-7 col-sm-7 col-xs-12">
        <div class="form-group">
            <div class='input-group date datetimepicker'>
                <input @isset($id) id="{{ $id }}" @endisset type='text' class="form-control" name="{{ $name }}" value="{{ old($name, $value ?? '') }}" />
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
            var $datetimepicker = $("input[name='{{ $name }}']").datetimepicker({
                locale: 'bg',
                format: 'DD.MM.YYYY',
                defaultDate: @if (@$value)
                    moment('{{ $value }}', 'DD.MM.YYYY')
                @elseif ($now ? true : false)
                    moment()
                @else
                    null
                @endif
            });

            $datetimepicker.find('input').on('focus', function() {
                $datetimepicker.datetimepicker('show');
            });
        });
    </script>
@endpush
