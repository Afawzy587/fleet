<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    include("./inc/Classes/system-reminders.php");
	$remind = new systemreminders();

    include("./inc/Classes/system-cars.php");
	$cars = new systemcars();

    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();

    include("./inc/Classes/system-users.php");
	$user = new systemusers();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['reminders_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $doc_type      = $informations->getdatatable("doc_type");  
                $_cars         = $cars->getsitecars();
                $users         = $user->getsiteusers();   
                if($_POST)
                {

				    $_doc_remind['reminders_type']                     =       "doc";
				    $_doc_remind['reminders_car_id']                   =       intval($_POST["car"]);
                    $_doc_remind['reminders_type_id']                  =       intval($_POST["doc_type"]);
                    $_doc_remind['reminders_repeat_number']            =       intval($_POST["annual_reminder_num"]);
                    $_doc_remind['reminders_type_reminder']            =       intval($_POST["annual_reminder"]);
                    $_doc_remind['reminders_repeat_kilo']              =       sanitize($_POST["annual_km"]);
                    $_doc_remind['reminders_type_remember']            =       intval($_POST["reminder_period"]);
                    $_doc_remind['reminders_remember_day']             =       intval($_POST["reminder_period_num"]);
                    $_doc_remind['reminders_remember_kilo']            =       sanitize($_POST["reminder_period_km"]);
                    $reminders=[];
                    foreach($_POST["reminded"] as $k => $v)
                    {
                        $reminders[$k]     = intval($v);
                    }
                    $_doc_remind['reminders'] = $reminders;
                    
                    if( $_FILES && ( $_FILES['att_doc']['name'] != "") && ( $_FILES['att_doc']['tmp_name'] != "" ) )
                    {
                        include_once("./inc/Classes/upload.class.php");
                        $allow_ext = array("jpg","jpeg","gif","png");
                        $upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
                        $files['name'] 	= addslashes($_FILES["att_doc"]["name"]);
                        $files['type'] 	= $_FILES["att_doc"]['type'];
                        $files['size'] 	= $_FILES["att_doc"]['size']/1024;
                        $files['tmp'] 	= $_FILES["att_doc"]['tmp_name'];
                        $files['ext']		= $upload->GetExt($_FILES["att_doc"]["name"]);
                        $upfile	= $upload->Upload_File($files);
                        if($upfile)
                        {
                            $_doc_remind['reminders_photo']  = $upfile['newname'];
                            
                        }
                    }
                    $add = $remind->add_New_reminders($_doc_remind);
                    if( $add == 1)
                    {
                        if(intval($_POST["add_other"]) == 1)
                        {
                            header("Location:./add_doc_reminder.php");
                            exit;
                        }else{
                            header("Location:./reminders_doc.php");
                            exit;
                        }
                    }
                     $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"reminders",
                            "mode" 		        => 	"add_doc_reminders",
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
                }
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
<main class="">
        <div
            class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"><?php echo $lang['REMINDERS'] ;?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong> <?php echo $lang['ADD_DOC_REMIND'] ;?></h4>
            </span>
        </div>
        <div class="container page_body">
            <div class="container page_body">
                <div class="row mt-5">
                    <div class="col">
                        <form class="add_doc_reminder" id="add_doc_reminder" method="post" enctype="multipart/form-data">
                            <div class="row white-bg">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-xs-3"><?php echo $lang['CAR'] ;?></label>
                                                <div class="col-xs-5">
                                                    <select data-live-search="true" class="form-control selectpicker" title="<?php echo $lang['CHOOSE'] ;?>" name="car">
                                                        
                                                        <?php foreach($_cars as $k => $c){
													           echo '<option value="'.$c['cars_sn'].'">'.$c['cars_code'].'</option>';
													   }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-xs-3"> <?php echo $lang['DOC_TYPE'] ;?></label>
                                                <div class="col-xs-5">
                                                    <select name="doc_type" class="md-select form-control ">
                                                        <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                                        <?php foreach($doc_type as $k => $d){
													           echo '<option value="'.$d['doc_type_sn'].'">'.$d['doc_type_name'].'</option>';
													   }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02" aria-describedby="inputGroupFileAddon01" name="att_doc">
                                                <label class="custom-file-label col-xs-3" for="inputGroupFile02"><?php echo $lang['ADD_DOC'];?></label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $lang['REPEAT_IN'];?></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input class="form-control" name="annual_reminder_num" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="annual_reminder" id="" class="md-select custom-select">
                                                            <option value="1"><?php echo $lang['DAY'];?> </option>
                                                            <option value="2"> <?php echo $lang['MONTH'];?></option>
                                                            <option value="3"> <?php echo $lang['YEAR'];?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-xs-3"><?php echo $lang['REMIND_KILOMETER'];?></label>
                                                <div class="col-xs-5">
                                                    <input class="form-control" name="annual_km" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><?php echo $lang['REMEMBER_IN'];?></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <input class="form-control" name="reminder_period_num"/>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="reminder_period" id="" class="md-select custom-select">
                                                            <option value="1"><?php echo $lang['DAY'];?> </option>
                                                            <option value="2"><?php echo $lang['MONTH'];?></option>
                                                            <option value="3"><?php echo $lang['YEAR'];?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-xs-3"><?php echo $lang['REMIND_KILOMETER'];?></label>
                                                <div class="col-xs-5">
                                                    <input class="form-control" name="reminder_period_km"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label class="small_label col-xs-3 "><?php echo $lang['KHWON_THAT'];?></label>
                                                <div class="col-xs-5">
                                                    <select class="mySelect for" multiple="multiple" name="reminded[]">
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
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control" name="add_other"  hidden>
                            <div class="row mt-3 bottom-actions">
                                <div class="col">
                                    <button class="add_other btn btn-light _btn ml-3" type="submit">   <?php echo $lang['SAVE_ADD_OTHER'];?></button> 
                                    <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"> <?php echo $lang['SAVE'];?></button>
                                    <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./reminders_doc.php"><?php echo $lang['CANCEL'];?></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
<script src="./assets/js/formValidation.js"></script>
<script src="./assets/js/framework/bootstrap.js"></script>
<script>
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
    $('#add_doc_reminder')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                car: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['CHOOSE_CAR'];?>'
                        }
                    }
                },
                doc_type: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_DOC_TYPE'];?>'
                        }
                    }
                },
//                att_doc: {
//                    validators: {
//                        notEmpty: {
//                            message: '<?php echo $lang['UPLOAD_DOC'];?>'
//                        }
//                    }
//                },
                annual_reminder_num: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['ADD_NUM'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['ONLY_NUMBER'];?>'
                        },
                        stringLength:{
                            max: 3,
                            message: '<?php echo $lang['MAX_NUMBER'];?>'
                        }
                    }
                },
                annual_reminder: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['annual_reminder'];?>'
                        }
                    }
                },
                annual_km: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['annual_km'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['ONLY_NUMBER'];?>'
                        },
                        stringLength:{
                            max: 6,
                            message: '<?php echo $lang['MAX_NUMBER'];?>'
                        }
                    }
                },
                reminder_period_num: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['ADD_NUM'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['ONLY_NUMBER'];?>'
                        },
                        stringLength:{
                            max: 3,
                            message: '<?php echo $lang['MAX_NUMBER'];?>'
                        }
                    }
                },
                reminder_period: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['annual_reminder'];?>'
                        }
                    }
                },
                reminder_period_km: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['annual_km'];?>'
                        },
                        digits:{
                            message: '<?php echo $lang['ONLY_NUMBER'];?>'
                        },
                        stringLength:{
                            max: 6,
                            message: '<?php echo $lang['MAX_NUMBER'];?>'
                        }
                    }
                },

                'reminded[]': {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_REMINDERS'];?>'
                        }
                    }
                }
            }
        }
        )
});


</script>