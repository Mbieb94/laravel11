"use strict";

var DataTable = function () {
    var table;

    var initDatatable = function () {
        table = $('#kt_datatable_example_1').DataTable({
            searchDelay: 500,
            processing: true,
            serverSide: true,
            fixedColumns: {
                left: 2,
                right: 1
            },
            select: {
                style: 'multi',
                selector: 'td:first-child input[type="checkbox"]',
                className: 'row-selected'
            },
            ajax: {
                url: urlDataTable,
                headers: {
                    'Authorization': `Bearer ${bearerToken}`
                },
                // dataSrc: function (json) {
                //     const { data } = json;
                //     return data.data;
                // },
                data: function (data) {
                    // data.params = searchAdvance;
                    data.search = data.search.value;
                },
                complete: function (result) {
                    $("#kt_datatable_example_1").find("th:first-child").removeClass("sorting_asc sorting_desc");
                    $('[data-bs-toggle="tooltip"]').tooltip();
                }
            },
            order: [[0, 'desc']],
            columns: columns,
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function (data) {
                        return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                    }
                },
                {
                    targets: -1,
                    orderable: false,
                    className: 'text-end',
                    render: function (data) {
                        return `
                            <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="left" data-kt-menu-flip="top-end">
                                <span class="m-0 svg-icon svg-icon-5"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Navigation/Angle-left.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path d="M6.70710678,15.7071068 C6.31658249,16.0976311 5.68341751,16.0976311 5.29289322,15.7071068 C4.90236893,15.3165825 4.90236893,14.6834175 5.29289322,14.2928932 L11.2928932,8.29289322 C11.6714722,7.91431428 12.2810586,7.90106866 12.6757246,8.26284586 L18.6757246,13.7628459 C19.0828436,14.1360383 19.1103465,14.7686056 18.7371541,15.1757246 C18.3639617,15.5828436 17.7313944,15.6103465 17.3242754,15.2371541 L12.0300757,10.3841378 L6.70710678,15.7071068 Z" fill="currentColor" fill-rule="nonzero" transform="translate(12.000003, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-12.000003, -11.999999) "/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                                Action
                            </a>
                            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px" data-kt-menu="true">
                                <div class="px-3 menu-item">
                                    <a href="#" class="px-3 menu-link d-flex justify-content-between">
                                        <span>Edit</span>    <i class="fas fa-pencil"></i> 
                                    </a>
                                </div>
                                <div class="px-3 menu-item">
                                    <a data-remote="#" class="px-3 menu-link d-flex justify-content-between">
                                        <span>Delete</span> <i class="fas fa-trash"></i> 
                                    </a>
                                </div>
                            </div>
                        `;
                    }
                },
            ]
        });

        table.on("draw", function () {
            KTMenu.createInstances();
        });
    }

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            table.search(e.target.value).draw();
        });
    }

    return {
        init: function () {
            initDatatable();
            handleSearchDatatable();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    DataTable.init();
});