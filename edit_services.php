<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-services.php");
	$services = new systemservices();

   
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
        if($group['services_edit'] == 0){
            header("Location:./permission.php");
            exit;
        }else
        {
            $mId  = intval($_GET['s']);
            if ($mId != 0)
            {
				$u = $services->getservicesInformation($mId);
                if ($_POST)
                {
                    $_service['services_sn']                       =       $mId;
                    $_service['services_name']                     =       sanitize($_POST["task_name"]);
                    $_service['services_notes']                    =       sanitize($_POST["task_description"],"area");

                        $update = $services  ->setservicesInformation($_service);
                        if ($update == 1)
                        {
                            header("Location:./services.php");
                            exit;
                        }
                    $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"services",
                            "mode" 		        => 	"edit_services",
                            "total" 		    => 	$mId,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
                }
            }else{
                header("Location:./error.php");
                exit;
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
                <h1 class="h2"><?php echo $lang['SERVICES']; ?></h1>
                <h4 class="sub_title">
                    <strong> &gt; </strong> <?php echo $lang['EDIT_SERVICE']; ?></h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    
                </div>
            </div>

        </div>
        <div class="container page_body">
            <div class="container page_body">
                <form action="" id="add_task_form" method="post" enctype="multipart/form-data">
                    <div class="row white-bg mt-2">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label  class="col-xs-3" for=""> <?php echo $lang['S_NAME']; ?></label>
                                        <div class="col-xs-5">
                                            <input type="text" class="form-control" name="task_name" maxlength="25" value="<?php echo $u['services_name'];?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-xs-3" for=""> <?php echo $lang['S_DES']; ?></label>
                                        <div class="col-xs-5">
                                            <textarea class="form-control" rows="5" name="task_description"><?php echo br2nl($u['services_notes']);?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="add_other"  hidden>
                    <div class="row mt-3 bottom-actions">
                        <div class="col">
                            <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"> <?php echo $lang['SAVE'];?></button>
                            <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="<?php echo $_SESSION['page'];?>"><?php echo $lang['CANCEL'];?></a>
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
    $('#add_task_form')
        .formValidation({
            excluded: [':disabled'],
            fields: {
                task_name: {
                    validators: {
                        notEmpty: {
                            message: '<?php echo $lang['INSERT_S_NAME']; ?>'
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
                            message: '<?php echo $lang['INSERT_S_DES']; ?>'
                        }
                    }
                }
            }
        })
});

</script>

