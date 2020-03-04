(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('needs-validation');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                attachmentvalidation();
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');

            }, false);
        });
    }, false);
})();

function attachmentvalidation() {
    var att = document.getElementsByClassName("custom-file-input");
    for (let index = 0; index < att.length; index++) {
        const element = att[index];
        if (element.value == "") {
            element.parentElement.nextElementSibling.classList.add('d-block');
        } else element.parentElement.nextElementSibling.classList.remove('d-block')
    }
}