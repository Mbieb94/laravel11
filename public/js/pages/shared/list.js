"use strict";

var List = function () {

    var handleModal = () => {
        $('#kt_modal_create_new').on('show.bs.modal', function (e) {
            const button = $(e.relatedTarget);
            const modal = $(this);

            modal.find('.modal-body').load(button.data('remote'), function () {
                Select2Reference.init();
            });
        });
    }

    var handleModalSubmit = () => {
        $('.btn-modal-submit').on('click', function (e) {
            let modal = $(this).closest('.modal');
            let form = modal.find('form');
            $(form).submit();
        })
    }

    return {
        init: function () {
            handleModal();
            handleModalSubmit();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    List.init();
});