var CustomJs = function (){
    var sidebarMenu = () => {
        $(".menu-item:not(.menu-accordion) > a").each(function () {
            var href = window.location.href.replace(/\?.*/g, "");
            if ($(this).attr('href') == href || href.indexOf($(this).attr('href') + '/') > -1) {
                $(this).addClass('active');
                $(this).closest('.parents').find('.child').addClass('active');
                $(this).parent().parents('.menu-accordion').addClass('here show');
            }
        })
    }

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
            sidebarMenu();
            toastrNotification();
        }
    }
}();

$(function () {
    CustomJs.init();
});