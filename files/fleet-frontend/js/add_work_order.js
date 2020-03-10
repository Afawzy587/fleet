tasklineCounter =1;
$('#add_task_line').click(function( event ) {
    var newTaskLine = $('#task_line').clone().prop('id', 'task_line'+tasklineCounter++ );
    $('#task_tablebody').append(newTaskLine);
});

partslineCounter =1;
$('#add_parts_line').click(function( event ) {
    var newPartsLine = $('#parts_line').clone().prop('id', 'parts_line'+partslineCounter++ );
    $('#parts_tablebody').append(newPartsLine);
});

$(document).ready(function () {
    $('#addWorkForm')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                car: {
                    validators: {
                        notEmpty: {
                            message: 'اختر السيارة'
                        }
                    }
                },
                supervisor: {
                    validators: {
                        notEmpty: {
                            message: 'اختر المسؤل'
                        }
                    }
                },
                prev_reading: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        },
                        digits:{
                            message: 'يجب أن يحتوي علي أرقام فقط'
                        }
                    }
                },
                current_reading: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة الحالية '
                        },
                        digits:{
                            message: 'يجب أن يحتوي علي أرقام فقط'
                        }
                    }
                },
                counter_image: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        }
                    }
                }
            }
        })
});
