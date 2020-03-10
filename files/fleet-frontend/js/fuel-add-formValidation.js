$(document).ready(function () {
    $('.add_fuel_form')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                car_code: {
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
                // date: {
                //     validators: {
                //         notEmpty: {
                //             message: 'أختر التاريخ '
                //         }
                //     }
                // },
                // time: {
                //     validators: {
                //         notEmpty: {
                //             message: 'أختر الوقت '
                //         }
                //     }
                // },
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
                },
                pump_image: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        }
                    }
                },
                bill_image: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        }
                    }
                },
                fuel_type: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        }
                    }
                },
                station_name: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        }
                    }
                },
                quantity: {
                    validators: {
                        notEmpty: {
                            message: 'أدخل القراءة السابقة '
                        },
                        digits:{
                            message: 'يجب أن يحتوي علي أرقام فقط'
                        }
                    }
                }
            }
        })
});
