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
	$reminders = new systemreminders();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
        $mId  = intval($_GET['r']);
        if ($mId != 0)
        {
            if($group['reminders_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $_reminder = $reminders->getremindersInformation($mId);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"reminders",
                            "mode" 		        => 	"dashboard",
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
                <?php if($_SESSION['page'] == "reminders.php") 
                    {
                        echo '<h1 class="h2">'.$lang['REMINDER_FIX_CAR'].'</h1>';
                    }else{
                        echo '<h1 class="h2">'.$lang['REMINDER_DOC_CAR'].'</h1>';
                    }
                ?>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button class="btn dark_btn">
                        <?php if ($_SESSION['page'] == "reminders.php") 
                            {
                                echo '<a href="./add_service_reminder.php?c='.$_reminder['reminders_car_id'].'">'.$lang['ADD_REMINDER'].'</a>';
                            }else{
                                echo '<a href="./add_doc_reminder.php?c='.$_reminder['reminders_car_id'].'">'.$lang['ADD_REMINDER'].'</a>';
                            }
                        ?>
                    </button>
                </div>
            </div>
        </div>
        <div class="container page_body">
            <div class="container page_body">
                <div class="row car_dashboard_header white-bg blue_border">
                    <div class="col-md-2"><img src="<?php echo $path.get_data('cars','cars_photo','cars_sn',$_reminder['reminders_car_id']) ;?>" width="100%"></div>
                    <div class="col-md-3">
                        <?php echo get_car_datails($_reminder['reminders_car_id'])?>
                    </div>
                    <div class="col-md-1 cars_status">
                        <p><i class="fas fa-circle working_car mr-3"></i><?php echo get_car_status($_reminder['reminders_car_id'])?></p>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-9">
                                <p><?php echo $lang['C_D_PROJECT'];?></p>
                            </div>
                            <div class="col-md-3">
                                <p class="safe_status"><?php echo get_car_project($_reminder['reminders_car_id'])?></p>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-9">
                                    <p><?php echo $lang['C_D_SUP'];?></p>
                                </div>
                                <div class="col-md-3">
                                    <p class="safe_status"><?php echo get_car_supervisor($_reminder['reminders_car_id'])?></p>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-2 car_actions">
                        <?php if($group['cars_edit'] == 1)
                                {
                                    echo'<a href="edit_car.php?c='.$_reminder['reminders_car_id'].'"><i class="far fa-edit safe_status"></i></a>';
                                }
                        ?>
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col _page_body white-bg">
                        <table class="table table-class  contacts_table table-hover" id="table-id">
                            <thead>
                                <tr  class="periwinkle-blue ">
                                    <td><?php echo $lang['REMINDER'];?></td>
                                    <td><?php echo $lang['PREV'];?></td>
                                    <td><?php echo $lang['NEXT'];?></td>
                                    <td><?php echo $lang['KHWON_THAT'];?></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($_reminder['reminders'] as $k => $r)
                                        {
                                            echo'
                                                <tr>
                                                    <td class="success_status">';
                                                    if($r['reminders_type'] == "service")
                                                    {
                                                        echo'<h6>'.get_service_type($r['reminders_type_id']).'</h6>';
                                                    }else{
                                                        echo'<h6>'.get_doc_type($r['reminders_type_id']).'</h6>';
                                                    }
                                                        
                                                   echo'</td>
                                                    <td> 
                                                        <span class="success_status">
                                                        <div>منذ 3 شهور</div>
                                                        <div>no</div>
                                                    </span>
                                                </td>
                                                <td class="success_status">
                                                    <h6>no</h6>
                                                </td>
                                                    <td>
                                                        <span>';
                                                        if(is_array(get_reminders_memmbers($r['reminders_sn'])))
                                                           {
                                                               foreach(get_reminders_memmbers($r['reminders_sn']) as $k => $v){
                                                                    echo '<div>'.$v['users_name'].'</div>';
                                                                }   
                                                           }else{
                                                               echo get_reminders_memmbers($u['reminders_sn']);
                                                           }                                                        
                                                    echo'</span>
                                                    </td>
                                                    <td class="actions">
                                                        <i class="far fa-envelope periwinkle-blue "></i>
                                                        <i class="fa fa-wrench warning_status"></i>';
                                                        if($r['reminders_type'] == "service")
                                                    {
                                                        echo'<a href="edit_service_reminder.php?r='.$r['reminders_sn'].'"><i class="far fa-edit success_status"></i></a>';
                                                    }else{
                                                        echo'<a href="edit_doc_reminder.php?r='.$r['reminders_sn'].'"><i class="far fa-edit success_status"></i></a>';
                                                    }
                                                        
                                                    echo'<i class="fas fa-trash danger_status" data-toggle="modal" data-target="#Deleteconfirmation"></i>
                                                    </td>
                                                </tr>
                                            '; 
                                            
                                        }   
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include './assets/layout/footer.php';?>

<script src="./assets/js/car-dashboard-charts.js">
