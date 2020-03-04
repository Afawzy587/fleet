(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                // var $field = $(".was-validated")[0];
                // console.log($field[0].parents('div'));
                // var $tabPane = $field.parents('.tab-pane'), tabId;
                // if ($tabPane && (tabId = $tabPane.attr('id'))) {
                //     ('a[href="#' + tabId + '"][data-toggle="tab"]').tab('show');
                // }

            }, false);
        });
    }, false);
})();