var CustomJs = function (){
    
    var toastrNotification = () => {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    
        if ($('body').attr('notification_success')) 
            toastr.success($('body').attr('notification_message'));
    
        if ($('body').attr('notification_warning'))
            toastr.warning($('body').attr('notification_message'));
    
        if ($('body').attr('notification_info'))
            toastr.info($('body').attr('notification_message'));
    
        if ($('body').attr('notification_error')) {
            let errorList = JSON.parse($('body').attr('notification_data'));
            for (i = 0; i < errorList.length; i++) {
                toastr.error(errorList[i])
            }
        }
    }

    return {
        init: function () {
            toastrNotification();
        }
    }
}();

$(function () {
    CustomJs.init();
});