<div class="mb-3 form-group row">
    <div class="col-xl-3 col-lg-3 col-form-label text-end">
        <label
            class="{{ isset($data['required']) && $data['required'] == true ? 'required' : '' }} form-label">{{ __($data['label']) }}</label>
    </div>
    <div class="col-lg-9 col-xl-9">
        <div class="row">
            <div class="col-lg-6 col-xl-6">
                <div class="input-group {{ isset($data['input_size']) ? 'input-group-' . $data['input_size'] : '' }}">
                    <span class="input-group-text">
                        <i class="ki-duotone ki-key fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <input type="password" name="{{ __($data['name']) }}" class="form-control password"
                        placeholder="{{ __(isset($data['placeholder']) ? $data['placeholder'] : $data['label']) }}">
                </div>
            </div>
            <div class="col-lg-6 col-xl-6">
                <div class="input-group {{ isset($data['input_size']) ? 'input-group-' . $data['input_size'] : '' }}">
                    <span class="input-group-text">
                        <i class="ki-duotone ki-key fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="{{ __('Password Confirmation') }}">
                </div>
            </div>
        </div>
        @if ($errors->has($data['name']))
            <small id="form-error-{{ $data['name'] }}" class="form-text text-danger">
                {{ $errors->first($data['name']) }}
            </small>
        @endif
    </div>
</div>
