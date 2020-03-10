
$(document).ready(function () {
    $('#addProjectForm')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                project_name: {
                    validators: {
                        notEmpty: {
                            message: 'ادخل اسم المشروع'
                        }
                    }
                },
                supervisor: {
                    validators: {
                        notEmpty: {
                            message: 'اختر المشرف / المدير'
                        }
                    }
                },
                representer: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل  ممثل العميل'
                        }
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: 'اختر تاريخ التعاقد  '
                        }
                    }
                },
                end_date: {
                    validators: {
                        notEmpty: {
                            message: 'اختر تاريخ انتهاء التعاقد '
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'ادخل رقم تليفون ممثل العميل '
                        },
                        regexp: {
                            regexp: /[0-9]{11}/,
                            message: 'ادخل رقم تليفون صحيح'
                        }
                    }
                },
                car_numbers: {
                    validators: {
                        notEmpty: {
                            message: 'ادخل عدد السيارات '
                        },
                        digits: {
                            message: 'يجب أن يكون أرقام فقط'
                        }
                    }
                },
                truck_type: {
                    validators: {
                        notEmpty: {
                            message: 'اختر نوع النقل'
                        }
                    }
                },
                max_monthly_km: {
                    validators: {
                        notEmpty: {
                            message: 'ادخل الحد الاقصي للكم الشهري '
                        },
                        digits: {
                            message: 'يجب أن يكون أرقام فقط'
                        }
                    }
                }
            }
        })
var trucktypesCounter= 1;
$('#add_truck_type').click(function(){
    var newtrucktype = $('#truck_type_item').clone().prop('id', 'truck_type_item'+ trucktypesCounter ++);
    $('#truck_types').append(newtrucktype);
})
$('#addCartoProject') .formValidation({
    excluded: [':disabled'],
    fields: {
        truck_type: {
            validators: {
                notEmpty: {
                    message: 'اختر نوع النقل'
                }
            }
        },
        car: {
            validators: {
                notEmpty: {
                    message: 'اختر السيارة'
                }
            }
        }
    }});
 $('#addRouteForm') .formValidation({
        excluded: [':disabled'],
        fields: {
            routeCode: {
                validators: {
                    notEmpty: {
                        message: 'أدخل كود خط السير'
                    },
                    digits: {
                        message: 'يجب أن يكون أرقام فقط'
                    }
                }
            },
            from: {
                validators: {
                    notEmpty: {
                        message: 'أدخل مكان البداية'
                    }
                }
            },
            to: {
                validators: {
                    notEmpty: {
                        message: 'أدخل مكان النهاية'
                    }
                }
            },
            distanceInKm: {
                validators: {
                    notEmpty: {
                        message: 'أدخل المسافة بالـ كم'
                    },
                    digits: {
                        message: 'يجب أن يكون أرقام فقط'
                    }
                }
            }
        }});

});