<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-projects.php");
	$projects = new systemprojects();

	include("./inc/Classes/system-users.php");
	$user = new systemusers();

    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
	
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['projects_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $transfer_type = $informations->getdatatable("transfer_type");                                         // transfer_type
				$users         = $user->getsiteusers();   
                if($_POST)
                {

                    $_project['projects_name']                         =       sanitize($_POST["project_name"]);
                    $_project['projects_manger_id']                    =       intval($_POST["supervisor"]);
                    $_project['projects_client']                       =       sanitize($_POST["representer"]);
                    $_project['projects_contract_start']               =      format_data_base(sanitize($_POST["start_date"]));
                    $_project['projects_contract_end']                 =      format_data_base(sanitize($_POST["end_date"]));
                    $_project['projects_client_phone']                 =       sanitize($_POST["phone"]);
                    
                    $car_number=[];
                    $truck_type=[];
                    $max_monthly_km=[];
                    foreach($_POST["car_number"] as $k => $v)
                    {
                        $car_number[$k]     = intval($v);
                        $truck_type[$k]     = intval($_POST["truck_type"][$k]);
                        $max_monthly_km[$k] = sanitize($_POST["max_monthly_km"][$k]);
                    }
                    $_project['project_car_types_car_number']          =       $car_number;
                    $_project['project_car_types_type_id']             =       $truck_type;
                    $_project['project_car_types_max_kilometer']       =       $max_monthly_km;
                    
					$add = $projects->addNewprojects($_project);
                    if( $add == 1)
                    {
                        if(intval($_POST["add_other"]) == 1)
                        {
                            header("Location:./add_projects.php");
                            exit;
                        }else{
                            header("Location:./projects.php");
                            exit;
                        }
                    }
                    

                }
            }
        include './assets/layout/header.php';
        include './assets/layout/navbar.php';
    }
?>
    <main class="">
        <div
            class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"> <?php  echo $lang['PROJECTS'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong><?php  echo $lang['ADD_PROJECT'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <div class="row mt-2">
                <div class="col mr-5 ">
                    <form action="" id="addProjectForm" method="post" enctype="multipart/form-data" novalidate>
                        <div class="row white-bg">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['PROJECT_NAME'];?></label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="project_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_SUPER'];?></label>
                                    <div class="col-xs-5">
                                        <select data-live-search="true" class="form-control selectpicker custom-select" title="<?php  echo $lang['CHOOSE'];?>" name="supervisor" required>
                                            <?php
                                                foreach($users as $k => $v)
                                                {
                                                    echo '<option value="'.$v['users_sn'].'" >'.$v['users_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_CLIENT_REP'];?></label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="representer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['CONTRACT_DATE'];?></label>
                                    <div class="col-xs-5">
                                        <input id="datepicker1" width="100%" name="start_date" autocomplete="off" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_END_IN'];?></label>
                                    <div class="col-xs-5">
                                        <input id="datepicker2" width="100%" name="end_date" autocomplete="off"/>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_CLIENT_PHONE'];?></label>
                                    <div class="col-xs-5">
                                        <input type="text" width="100%" name="phone" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row white-bg mt-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col" id="truck_types">
                                        <div class="row" id="truck_type_item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-xs-3"><?php  echo $lang['P_CAR_NUM'];?></label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control small_input" name="car_number[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-xs-3"><?php  echo $lang['SYS_TRANSFER'];?></label>
                                                    <div class="col-xs-5">
                                                        <select class="form-control md-select" title="<?php  echo $lang['CHOOSE'];?>" name="truck_type[]">
                                                            <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                                            <?php
                                                                foreach($transfer_type as $k => $t)
                                                                {
                                                                    echo '<option value="'.$t['transfer_type_sn'].'" >'.$t['transfer_type_name'].'</option>';
                                                                }
                                                            ?>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-xs-3"><?php  echo $lang['PRO_MAX_KILO'];?></label>
                                                    <div class="col-xs-5">
                                                        <input type="text" name="max_monthly_km[]" class="form-control small_input" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row  add_type_row">
                                    <div class="add_item pale-teal" id="add_truck_type">
                                        <i class="fas fa-plus-circle darkish-green"></i>
                                        <?php  echo $lang['PRO_ADD_TYPE_TRAN'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="text" class="form-control" name="add_other"  hidden>
                        <div class="row mt-3 bottom-actions">
                            <div class="col">
                                <button class="add_other btn btn-light _btn ml-3" type="submit">   <?php echo $lang['SAVE_ADD_OTHER'];?></button> 
                                <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"> <?php echo $lang['SAVE'];?></button>
                                <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./projects.php"><?php echo $lang['CANCEL'];?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
<script src="./assets/js/formValidation.js"></script>
<script src="./assets/js/framework/bootstrap.js"></script>
<script>
    $(document).ready(function () {
    $('#addProjectForm')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                project_name: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_PROJECT_NAME'];?>'
                        }
                    }
                },
                supervisor: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_PRO_SUP'];?>'
                        }
                    }
                },
                representer: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_P_CLIENT_REP'];?>'
                        }
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_DATE'];?>'
                        },
                        date: {
                            format: 'MM/DD/YYYY'
                        }
                    }
                },
                end_date: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_END_DATE'];?>'
                        },
                        date: {
                            format: 'MM/DD/YYYY'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_PRO_PHONE'];?>'
                        },
                        regexp: {
                            regexp: /[0-9]{11}/,
                            message: '<?php echo $lang['INSERT_PHONE_CORRECT'];?>'
                        }
                    }
                },
                'car_number[]': {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_CAR_NUM'];?>'
                        },
                        digits: {
                            message: '<?php echo $lang['CORRECT_CAR_NUM'];?>'
                        }
                    }
                },
                'truck_type[]': {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_TYPE'];?>'
                        }
                    }
                },
                'max_monthly_km[]': {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_MAX_KILO'];?>'
                        },
                        digits: {
                            message: '<?php echo $lang['CORRECT_CAR_NUM'];?>'
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



</script>
