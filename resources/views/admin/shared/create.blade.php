<form action="{{ url(Request::segment(1)) }}" method="POST" id="formValidate" enctype="multipart/form-data">
    @csrf
    @php 
        $fieldRequired = [];
    @endphp
    @foreach ($forms as $form)
        @if (isset($form['hidden']) && $form['hidden'] == true)
            @continue
        @endif

        @if($form['required'])
            @php
            $fieldRequired[$form['name']] = __($form['label']);
            @endphp
        @endif
        
        @component('components.' . $form['type'] . '.input', ['data' => $form])
        @endcomponent
    @endforeach
</form>
<input type="hidden" id="filed-required" value='@json($fieldRequired)'>

<script src="{{ asset('js/plugins/jquery-validate/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/pages/shared/formValidation.js') }}"></script>