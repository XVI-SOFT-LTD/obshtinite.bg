@if (isset($line) && $line)
    <div class="ln_solid"></div>
@endif

<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
        <button type="submit" name="{{ $name }}" class="btn btn-success">{{ $label }}</button>
    </div>
</div>
