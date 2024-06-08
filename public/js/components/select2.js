var Select2Reference = function () {
    var select2 = () => {
        const element = $("select.select2reference");

        element.each(async function (e) {
            $(this).select2();
            const select = $(this);
            const table = select.data('table');
            const key = select.data('key');
            const display = select.data('display');
            const defaultValue = select.data('value') ? select.data('value') : null;
            let url = hostUrl + `${baseUrlApi}/components/select2reference/${table}/${key}/${display}`;
            
            await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                }
            }).then((res) => res.json())
            .then((resp) => {
                const { results } = resp;
                $(select).empty();
                for (let i = 0; i < results.length; i++) {
                    var options = new Option(results[i].text, results[i].id, false, false);
                    $(select).append(options);
                }
                $(select).val(defaultValue).trigger('change');
            });
        });
    }

    var sysparamReference = () => {
        const element = $("select.sysparam-reference");

        element.each(async function (e) {
            $(this).select2();
            const select = $(this);
            const group = select.data('group');
            const defaultValue = select.data('value') ? select.data('value') : null;
            const url = `${baseUrlApi}/components/sysparam-reference/${group}`;

            await fetch(url, {
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                }
            }).then((res) => res.json())
                .then((resp) => {
                    const { data } = resp;
                    $(select).empty();
                    for (let i = 0; i < data.length; i++) {
                        var options = new Option(data[i].value, data[i].key, false, false);
                        $(select).append(options);
                    }
                    $(select).val(defaultValue).trigger('change');
                });
        });

    }
    
    return {
        init: function () {
            select2();
            sysparamReference();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    Select2Reference.init();
});