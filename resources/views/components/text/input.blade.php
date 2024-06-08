<div class="mb-3 form-group row">
    <div class="col-xl-3 col-lg-3 col-form-label text-end">
        <label
            class="{{ isset($data['required']) && $data['required'] == true ? 'required' : '' }} form-label">{{ __($data['label']) }}</label>
    </div>
    <div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
        <div class="input-group {{ isset($data['input_size']) ? 'input-group-' . $data['input_size'] : '' }}">
            <input type="text" name="{{ $data['name'] }}" class="form-control" placeholder="{{ $data['label'] }}"/>
        </div>
    </div>
</div>