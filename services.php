<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    $_SESSION['page']  = $basename;
    include("./inc/Classes/system-services.php");
	$services = new systemservices();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['services_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $_services       = $services->getsiteservices();
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"services",
                            "mode" 		        => 	"list",
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
    <main class="">
        <div
            class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2">  <?php echo $lang['SERVICES'];?></h1>
                <h4 class="sub_title">
                    <strong> &gt; </strong>  <?php echo $lang['SERVICE_ACTION'];?></h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <?php
                        if($group['services_add'] == 1){
                            echo '<button class="btn dark_btn"> <a href="./add_services.php">'.$lang['ADD_SERVICE'].'</a></button>';
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li <?php if($page_name == "services_list"){echo "class='active'";}?>>
                            <a href="./services_list.php"><?php echo $lang['SERVICE_LIST'];?></a>
                        </li>
                        <li <?php if($page_name == "job_orders"){echo "class='active'";}?>>
                            <a href="./job_orders.php"><?php echo $lang['JOB_ORDERS'];?></a>
                        </li >
                        <li <?php if($page_name == "services"){echo "class='active'";}?>>
                            <a href="services.php"><?php echo $lang['SERVICE_ACTION'];?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="container page_body">
                <div class="row white-bg mt-2">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-12 bottom_border task_item">
                                <h6 class="periwinkle-blue"><?php echo $lang['S_NAME'];?></h6>
                            </div>
                        </div>
                        <div class="row">
                            
                            <?php foreach($_services as $k => $s)
                            {
                                echo'<div class="col-md-3 bottom_border task_item">
                                <span>
                                    <h6 class="bold_text">'.$s['services_name'].'</h6>
                                </span>
                                <span>';
                                    if($group['services_edit'] == 1)
                                    {
                                        echo '<a class="mr-2" href="./edit_services.php?s='.$s['services_sn'].'"><i class="far fa-edit darkish-green"></i></a>';
                                    }
                                    if($group['services_delete'] == 1)
                                    {
                                        echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Deleteconfirmation_'.$s['services_sn'].'"></i>';
                                    }
                            echo'</span>
                            </div>
                            <!-- confirm delete Modal -->
											<div class="modal fade addModal" id="Deleteconfirmation_'.$s['services_sn'].'" tabindex="-1" role="dialog"
												aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered " role="document">
													<div class="modal-content dark_bg">

														<div class="modal-body">
															<h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
														</div>
														<div class="modal-footer">
															<button type="button" class="delete_services btn _btn btn-light" id='.$s['services_sn'].' data-dismiss="modal">'.$lang['CONFORM'].'</button>
															<button type="button" class="btn _btn btn-danger rose-bg delete_confirmation_btn" data-dismiss="modal">'.$lang['SYS_CANCEL'].'</button>
														</div>
													</div>
												</div>
											</div>
											';
                            }?>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </main>

<?php include './assets/layout/footer.php';?>