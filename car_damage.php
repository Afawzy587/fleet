<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-damages.php");
	$car_damage = new systemcar_damage();

    include("./inc/Classes/system-cars.php");
	$cars = new systemcars();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
        $mId  = intval($_GET['c']);
        if ($mId != 0)
        {
            if($group['check_item_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $_damage = $car_damage->getcar_damageInformation($mId);
                $_car    = $cars->getcarsInformation($mId);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"car_damage",
                            "mode" 		        => 	"damage_list",
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
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
    <main class="">
        <div
            class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"><?php echo $lang['DAMAGE_LIST'];?></h1>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button class="btn dark_btn">
                        <a href="./add_damage.php?c=<?php echo $mId;?>"><?php echo $lang['DAMAGE_ADD'];?></a>
                    </button>
                </div>
            </div>

        </div>
        <div class="container page_body">
        <div class="container page_body">
            <div class="row car_dashboard_header white-bg blue_border">
                <div class="col-md-2"><img src="<?php echo $path.$_car['cars_photo'];?>" width="100%"></div>
                <div class="col-md-3">
                    <?php
                            echo'<p>'.$_car['cars_code'].' - '.'['.$_car['cars_model'].']'.'</p>
                                <p>'.$lang['CAR_MODEL'].' '.$_car['cars_year'].'</p>
                                <p>'.$_car['cars_plate_number'].'</p>';
                        ?>
                </div>
                <div class="col-md-2 cars_status">
                    <p><i class="fas fa-circle working_car"></i><?php echo get_data("car_status","car_status_name","car_status_sn",$_car['cars_car_status'])?></p>
                </div>
                <div class="col-md-3">
                    <div class="inline_content">
                        <p><?php echo $lang['C_D_PROJECT'];?></p>
                        <p class="safe_status"><?php echo get_data("projects","projects_name","projects_sn",$_car['cars_project_id'])?></p>
                    </div>
                    <div class="inline_content">
                        <p><?php echo $lang['C_D_SUP'];?></p>
                        <p class="safe_status"><?php echo get_data("users","users_name","users_sn",$_car['cars_supervisor_id'])?></p>
                    </div>
                </div>
                <div class="col-md-2 car_actions">
                    <a href="./edit_car.php?c=<?php echo $_car['cars_project_id'];?>">
                        <i class="far fa-edit safe_status"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col _page_body white-bg">
                        <table class="table table-class  contacts_table table-hover" id="table-id" >
                           <input type="hidden" value="car_damage" id="table">
                           <input type="hidden" value="check_item_delete" id="permission">
                            <thead>
                                <tr>
                                    <th class="center"><?php echo $lang['DATE'];?> </th>
                                    <th> <?php echo $lang['DATE'];?></th>
                                    <th> <?php echo $lang['NOTES'];?></th>
                                    <th> <?php echo $lang['DAMAGE_STATUS'];?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody > 
                            <?php foreach($_damage as $k => $d){
                                    echo'<tr id=tr_'.$d['car_damage_sn'].'>
                                            <td  class="center">
                                                <h6>'.$d['car_damage_date'].'</h6>
                                                <!--<h6 class="time_direction">10:45 AM</h6>--!>
                                            </td>
                                            <td>'.$d['car_damage_name'].'</td>
                                            <td> '.$d['car_damage_text'].'</td>
                                            <td>';
                                            if($d['car_damage_status'] == 1)
                                            {
                                                echo '<h6 class="success_status">'.$lang['CLOSED'].'</h6>';
                                            }else{
                                                echo '<h6 class="warning_status">'.$lang['OPENED'].'</h6>';
                                            }
                                            echo'</td>
                                            <td class="actions">';
                                            if($d['car_damage_status'] == 0)
                                            {
                                                echo '<i class="fa fa-wrench warning_status"></i>';
                                                        if($group['end_check'] ==1)
                                                        {
                                                            echo '<i class="end_damage fa fa-times-circle close_action" id="'.$d['car_damage_sn'].'"></i>';
                                                        }
                                                        if($group['check_item_edit'] ==1)
                                                        {
                                                            echo '<a href="./edit_damage.php?d='.$d['car_damage_sn'].'">
																	<i class="far fa-edit success_status"></i>
																  </a>';
                                                        }
                                                      if($group['check_item_delete'] ==1)
                                                        {
														  	echo'<i class="fas fa-trash danger_status" data-toggle="modal" data-target="#Delete_'.$d['car_damage_sn'].'"></i>
																<!-- confirm delete Modal -->
																<div class="modal fade addModal" id="Delete_'.$d['car_damage_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-centered " role="document">
																		<div class="modal-content dark_bg">

																			<div class="modal-body">
																				<h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
																			</div>
																			<div class="modal-footer" id="item_'.$k.'">
																				<button type="button" id="item_'.$d['car_damage_sn'].'" class="btn _btn  btn-light  delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
																				<button type="button" class="btn _btn  btn-danger rose-bg" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
																			</div>
																		</div>
																	</div>
																</div>
															';
                                                        }  
                                            }
                                            echo'</td>
                                        </tr>';

                                    }?>    
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
 </main>
<?php include './assets/layout/footer.php';?>



