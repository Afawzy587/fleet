<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-cars.php");
	$_cars = new systemcars();

    include("./inc/Classes/system-car_fuel.php");
	$fuels = new systemcar_fuel();
	include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
	include("./inc/Classes/system-users.php");
	$user = new systemusers();
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['car_fuel_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
				
                $fuel_type     = $informations->getdatatable("fuel_type");                                             // fuel_type
				$users         = $user->getsiteusers();   
				$cars          = $_cars->getsitecars();   
                if($_POST)
                {
                    $_fuel['car_fuel_car_id']                 =       intval($_POST["car_code"]);
                    $_fuel['car_fuel_by']                     =       intval($_POST["supervisor"]);
                    $_fuel['car_fuel_previous_read']          =       sanitize($_POST["prev_reading"]);
                    $_fuel['car_fuel_date']                   =       format_data_base(sanitize($_POST["date"]));
                    $_fuel['car_fuel_time']                   =       sanitize($_POST["time"]);
                    $_fuel['car_fuel_now_read']               =       sanitize($_POST["current_reading"]);
                    $_fuel['car_fuel_fuel_id']                =       intval($_POST["fuel_type"]);
                    $_fuel['car_fuel_station']                =       sanitize($_POST["station_name"]);
                    $_fuel['car_fuel_amount']                 =       sanitize($_POST["quantity"]);
                    $_fuel['car_fuel_cost']                   =       (get_data("fuel_type","price","fuel_type_sn",intval($_POST['fuel_type'])) * sanitize($_POST["quantity"]));

                    
                    
                    if( $_FILES && ( $_FILES['counter_image']['name'] != "") && ( $_FILES['counter_image']['tmp_name'] != "" ) )
                    {
                        include_once("./inc/Classes/upload.class.php");
                        $allow_ext = array("jpg","jpeg","gif","png");
                        $upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
                        $files['name'] 	= addslashes($_FILES["counter_image"]["name"]);
                        $files['type'] 	= $_FILES["counter_image"]['type'];
                        $files['size'] 	= $_FILES["counter_image"]['size']/1024;
                        $files['tmp'] 	= $_FILES["counter_image"]['tmp_name'];
                        $files['ext']		= $upload->GetExt($_FILES["counter_image"]["name"]);
                        $upfile	= $upload->Upload_File($files);
                        if($upfile)
                        {
                            $_fuel['car_fuel_counter_photo']  = $upfile['newname'];
                            
                        }
                    }
                    if( $_FILES && ( $_FILES['pump_image']['name'] != "") && ( $_FILES['pump_image']['tmp_name'] != "" ) )
                    {
                        include_once("./inc/Classes/upload.class.php");
                        $allow_ext = array("jpg","jpeg","gif","png");
                        $upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
                        $files['name'] 	= addslashes($_FILES["pump_image"]["name"]);
                        $files['type'] 	= $_FILES["pump_image"]['type'];
                        $files['size'] 	= $_FILES["pump_image"]['size']/1024;
                        $files['tmp'] 	= $_FILES["pump_image"]['tmp_name'];
                        $files['ext']		= $upload->GetExt($_FILES["pump_image"]["name"]);
                        $upfile	= $upload->Upload_File($files);
                        if($upfile)
                        {
                            $_fuel['car_fuel_pump_photo']  = $upfile['newname'];
                            
                        }
                    }
                    
                    if( $_FILES && ( $_FILES['bill_image']['name'] != "") && ( $_FILES['bill_image']['tmp_name'] != "" ) )
                    {
                        include_once("./inc/Classes/upload.class.php");
                        $allow_ext = array("jpg","jpeg","gif","png");
                        $upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
                        $files['name'] 	= addslashes($_FILES["bill_image"]["name"]);
                        $files['type'] 	= $_FILES["bill_image"]['type'];
                        $files['size'] 	= $_FILES["bill_image"]['size']/1024;
                        $files['tmp'] 	= $_FILES["bill_image"]['tmp_name'];
                        $files['ext']		= $upload->GetExt($_FILES["bill_image"]["name"]);
                        $upfile	= $upload->Upload_File($files);
                        if($upfile)
                        {
                            $_fuel['car_fuel_invoice_photo']  = $upfile['newname'];
                            
                        }
                    }
					$add = $fuels->addNewcar_fuel($_fuel);
                    if( $add == 1){
                         if(intval($_POST["add_other"]) == 1)
                            {
                                header("Location:./add_fuel.php");
                                exit;
                            }else{
                                header("Location:./fuel.php");
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
                <h1 class="h2"> <?php  echo $lang['FUEL'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong><?php  echo $lang['ADD_CAR_FUEL'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <div class="container page_body">
                <form method="post" action="./add_fuel.php" class="add_fuel_form" enctype="multipart/form-data" >
                    <div class="row">
                        <div class="col white-bg">
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-xs-3"><?php  echo $lang['CAR'];?></label>
                                        <div class="col-xs-5">
                                            <select data-live-search="true" class=" selectpicker" name="car_code">
                                                <?php
                                                     echo '<option value="" >'.$lang['CHOOSE'].'</option>';
                                                    foreach($cars as $k => $c)
                                                    {
                                                        echo '<option value="'.$c['cars_sn'].'" >'.$c['cars_code'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-xs-3"><?php  echo $lang['BY'];?></label>
                                        <div class="col-xs-5">
                                            <select data-live-search="true" class="form-control selectpicker" name="supervisor">
                                                <?php
                                                     echo '<option value="" >'.$lang['CHOOSE'].'</option>';
                                                    foreach($users as $k => $s)
                                                    {
                                                        echo '<option value="'.$s['users_sn'].'" >'.$s['users_name'].'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-xs-3"><?php  echo $lang['PREV_READ'];?></label>
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control small_input" name="prev_reading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-xs-3"><?php  echo $lang['DATE'];?></label>
                                        <div class="col-xs-5">
                                            <input id="datepicker1" class="form-control" width="100%" name="date" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-xs-3"> <?php  echo $lang['TIME'];?></label>
                                        <div class="col-xs-5">
                                            <input id="timepicker1" class="form-control" width="100%" name="time" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-xs-3"><?php  echo $lang['CURRENT_READ'];?></label>
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control small_input" name="current_reading">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row white-bg ">
                        <div class="col">
                            <h5 class=" tangerine"><?php  echo $lang['FUEL_DETAILS'];?></h5>
                        </div>
                    </div>
                    <div class="row white-bg mt-1 ">
                        <div class="col-md-4 form-group">
                            <div class="custom-file col-xs-5">
                                <input type="file" name="counter_image" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile02"><?php  echo $lang['COUNTER_IMAGE'];?></label>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="custom-file col-xs-5">
                                <input type="file" name="pump_image" class="custom-file-input" id="inputGroupFile02"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile02"><?php  echo $lang['PUMP_IMAGE'];?></label>
                            </div>
                        </div>
                        <div class="col-md-4 form-group">
                            <div class="custom-file col-xs-5">
                                <input type="file" name="bill_image" class="custom-file-input" id="inputGroupFile02"
                                    aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile02"><?php  echo $lang['INVOICE_IMAGE'];?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row white-bg mt-1 flex_items_btween">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-xs-3"> <?php  echo $lang['SYS_FUEL_TYPE'];?></label>
                                <div class="col-xs-5">
                                    <select class="form-control md-select" name="fuel_type">
                                        <?php
                                             echo '<option value="" >'.$lang['CHOOSE'].'</option>';
                                            foreach($fuel_type as $k => $t)
                                            {
                                                echo '<option value="'.$t['fuel_type_sn'].'">'.$t['fuel_type_name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-xs-3"> <?php  echo $lang['STATION_NAME'];?></label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" name="station_name" maxlength="25" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row white-bg mt-1">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="col-xs-3"> <?php  echo $lang['QUANTITY'];?></label>
                                <div class="col-xs-5">
                                    <input type="text" class="form-control" name="quantity" maxlength="25">
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="add_other"  maxlength="25" hidden>
                    <div class="row mt-3 bottom-actions">
                        <div class="col">
                            <div class="col">
                            <button class="add_other btn btn-light _btn ml-3" type="submit">   <?php echo $lang['SAVE_ADD_OTHER'];?></button> 
                            <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"> <?php echo $lang['SAVE'];?></button>
                            <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./fuel.php"><?php echo $lang['CANCEL'];?></a>
                        </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </main>

<?php include './assets/layout/footer.php';?>
<script src="./assets/js/formValidation.js"></script>
<script src="./assets/js/framework/bootstrap.js"></script>
<script>
    $(document).ready(function () {
    $('#add_fuel_form')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                car_code: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_CAR'];?>'
                        }
                    }
                },
                supervisor: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_SUP'];?>'
                        }
                    }
                },
                prev_reading: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_PREV_READ'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['CORRECT_CAR_NUM'];?>'
                        }
                    }
                },
                 date: {
                     validators: {
                         notEmpty: {
                             message: '  <?php echo $lang['CHOOSE_DATE'];?>'
                         },
                        date: {
                            format: 'MM/DD/YYYY'
                        }
                     }
                 },
                 time: {
                     validators: {
                         notEmpty: {
                             message: '<?php echo $lang['CHOOSE_TIME'];?>'
                         },
                         time:{
                        }
                     }
                 },
                current_reading: {
                    validators: {
                        notEmpty: {
                            message: ' <?php echo $lang['INSERT_CURRENT_READ'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['CORRECT_CAR_NUM'];?>'
                        }
                    }
                },
                counter_image: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_COUNER_IMAG'];?>'
                        }
                    }
                },
                pump_image: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_PUMP_IMAG'];?>'
                        }
                    }
                },
                bill_image: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_INVOICCE_IMAG'];?>'
                        }
                    }
                },
                fuel_type: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_FUEL_TYPE'];?>'
                        }
                    }
                },
                station_name: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_STATION_NAME'];?>'
                        }
                    }
                },
                quantity: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_QUANTITY'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['CORRECT_CAR_NUM'];?> '
                        }
                    }
                }
            }
        })
});
</script>
