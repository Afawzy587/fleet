$(document).ready(function () {
    $('.select2-selection__rendered input').attr('placeholder', 'nnnnn');
    console.log($('.select2-selection__rendered'));
    console.log($('input.select2-search__field').attr('placeholder'));

    // Multiple-Select
    var data = []; // Programatically-generated options array with > 5 options
    var placeholder = "select";
    $(".mySelect").select2({
        data: data,
        placeholder: placeholder,
        allowClear: false,
        minimumResultsForSearch: 5
    });




    // form validation
    $('#add_service_reminder')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                car: {
                    validators: {
                        notEmpty: {
                            message: ' أختر السيارة'
                        }
                    }
                },
                service_type: {
                    validators: {
                        notEmpty: {
                            message: ' أختر نوع خدمة الصيانة'
                        }
                    }
                },
                annual_reminder_num: {
                    validators: {
                        notEmpty: {
                            message: ' أدخل العدد'
                        },
                        digits:{
                            message: 'أرقام فقط'
                        },
                        stringLength:{
                            max: 3,
                            message: '- الحد الأقصي 3 أرقام '
                        }
                    }
                },
                annual_reminder: {
                    validators: {
                        notEmpty: {
                            message: ' أختر الفترة'
                        }
                    }
                },
                annual_km: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل الكيلومترات'
                        },
                        digits:{
                            message: 'أرقام فقط',
                            max: 3
                        },
                        stringLength:{
                            max: 6,
                            message: '- الحد الأقصي 6 أرقام '
                        }
                    }
                },
                reminder_period_num: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل العدد'
                        },
                        digits:{
                            message: 'أرقام فقط'
                        },
                        stringLength:{
                            max: 3,
                            message: '- الحد الأقصي 3 أرقام '
                        }
                    }
                },
                reminder_period: {
                    validators: {
                        notEmpty: {
                            message: 'أختر الفترة'
                        }
                    }
                },
                reminder_period_km: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل الكيلومترات'
                        },
                        digits:{
                            message: 'أرقام فقط'
                        },
                        stringLength:{
                            max: 6,
                            message: '- الحد الأقصي 6 أرقام '
                        }
                    }
                },

                reminded: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل اسم الاشخاص المراد تنبيههم'
                        }
                    }
                }
            }
        }
        )
});

