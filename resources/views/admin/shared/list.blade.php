@extends('layouts.app')

@section('meta')
    
@endsection

@section('content')
<div id="kt_content_container" class="container-xxl">
    <div class="card card-flush h-md-100">
        <div class="card-header pt-7">
            <div class="my-1 d-flex align-items-center position-relative">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <input type="text" data-kt-table-filter="search"
                    class="form-control form-control-solid w-250px ps-14"
                    placeholder="{{ __('Search') }} {{ __(request()->segment(1)) }}" />
            </div>
            <div class="d-flex justify-content-end" data-kt-table-toolbar="base">

                <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>        Filter
                </button>
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" style="">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>
                    <div class="px-7 py-5" data-kt-table-filter="form">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Role:</label>
                            <select class="form-select form-select-solid fw-bold select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-table-filter="role" data-hide-search="true" data-select2-id="select2-data-10-2t05" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                <option data-select2-id="select2-data-12-z5hn"></option>
                                <option value="Administrator">Administrator</option>
                                <option value="Analyst">Analyst</option>
                                <option value="Developer">Developer</option>
                                <option value="Support">Support</option>
                                <option value="Trial">Trial</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-d38c" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid fw-bold" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-ttbs-container" aria-controls="select2-ttbs-container"><span class="select2-selection__rendered" id="select2-ttbs-container" role="textbox" aria-readonly="true" title="Select option"><span class="select2-selection__placeholder">Select option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>

                        <div class="mb-10">
                            <label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
                            <select class="form-select form-select-solid fw-bold select2-hidden-accessible" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-table-filter="two-step" data-hide-search="true" data-select2-id="select2-data-13-9h2w" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                <option data-select2-id="select2-data-15-qxcr"></option>
                                <option value="Enabled">Enabled</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-14-y3vq" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid fw-bold" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-yxdy-container" aria-controls="select2-yxdy-container"><span class="select2-selection__rendered" id="select2-yxdy-container" role="textbox" aria-readonly="true" title="Select option"><span class="select2-selection__placeholder">Select option</span></span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                        </div>
                        <!--end::Input group-->
                
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-table-filter="filter">Apply</button>
                        </div>
                        <!--end::Actions-->
                    </div>
                    <!--end::Content-->
                </div>

                <a data-remote="{{ url(Request::segment(1) . '/create') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_new">
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                fill="currentColor" />
                        </svg>
                    </span>{{ __('Add ' . str_replace('_', ' ', request()->segment(1))) }}
                </a>
                <div class="me-0">
                    <button class="btn btn-lg btn-icon btn-bg-transparent btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/General/Other1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <circle fill="currentColor" cx="12" cy="5" r="2"/>
                                <circle fill="currentColor" cx="12" cy="12" r="2"/>
                                <circle fill="currentColor" cx="12" cy="19" r="2"/>
                            </g>
                        </svg><!--end::Svg Icon--></span>
                    </button>
                    <!--begin::Menu 3-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true">
                        <!--begin::Heading-->
                        <div class="menu-item px-3">
                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">
                                Tools
                            </div>
                        </div>
                        <!--end::Heading-->
                        <div class="menu-item px-3">
                            <a href="javascript:;" data-remote="{{ url(Request::segment(1) . '/export') }}" class="menu-link px-3" data-kt-export="all">
                                Export to Excel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-table-toolbar="selected">
                <div class="fw-bolder me-5">
                    <span class="me-2" data-kt-table-select="selected_count"></span>{{ __('Selected') }}
                </div>
                <button type="button" class="btn btn-danger"
                    data-kt-table-select="delete_selected">{{ __('Delete Selected') }}</button>
            </div>
        </div>
        <div class="card-body pt-6">
            <div class="kt_table_users_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                        id="kt_datatable_example_1">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="w-10px pe-2">
                                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                                            data-kt-check-target="#kt_datatable_example_1 .form-check-input"/>
                                    </div>
                                </th>
                                @php
                                    $column = [['data' => 'id']];
                                @endphp
                                @foreach ($forms as $key => $items)
                                    @if ($items['display'])
                                        <th class="text-nowrap">{{ __($items['label']) }}</th>
                                        @php
                                            $column[] = ['data' => $items['name']];
                                        @endphp
                                    @endif
                                @endforeach
                                @php
                                    $column[] = ['data' => null];
                                @endphp
                                <th class="text-end min-w-100px"></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components.modal.static', [
    'id' => 'kt_modal_create_new', 
    'modalTitle' => 'Create ' . request()->segment(1)
])

@endsection

@section('custom-js')
    <script>
        var columns = @json($column);
    </script>
    <script src="{{ asset('js/pages/shared/dataTable.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validate/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/pages/shared/list.js') }}"></script>
@endsection