$(document).ready(function () {
    $('#add_task_form')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                task_name: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل اسم الاجراء'
                        }
                        // remote: {
                        //     type: 'POST',
                        //     url: 'test.php',
                        //     message: 'هذا الاجراء موجود بالفعل',
                        //     delay: 2000
                        // }
                    }
                },
                task_description: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل وصف الاجراء'
                        }
                    }
                }
            }
        })
});
