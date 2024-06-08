<div class="mb-3 form-group row">
    <div class="col-xl-3 col-lg-3 col-form-label text-end">
        <label
            class="{{ isset($data['required']) && $data['required'] == true ? 'required' : '' }} form-label">{{ __($data['label']) }}</label>
    </div>
    <div class="col-lg-9 col-xl-{{ isset($data['column']) ? $data['column'] : '9' }}">
        <div class="input-group {{ isset($data['input_size']) ? 'input-group-' . $data['input_size'] : '' }}">
            <select 
                name="{{ $data['name'] }}" 
                class="form-select {{ isset($data['input_size']) ? 'form-select-' . $data['input_size'] : '' }} sysparam-reference" 
                data-control="select2" 
                data-dropdown-parent="#{{ isset($data['modal_id']) ? $data['modal_id'] : 'kt_modal_create_new' }}" 
                data-placeholder="Select {{ $data['label'] }}" 
                data-allow-clear="true"
                data-group="{{ $data['group'] }}"
            >
                <option></option>
            </select>
        </div>
    </div>
</div>