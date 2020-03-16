<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    
    if($login->doCheck() == false)
    {
        header("Location:./login.php");
        exit;
    }else{
        switch($_GET['do'])
		{
            case"car":
                if($_POST)
                {
                    include("./inc/Classes/system-cars.php");
                    $cars     = new systemcars();
                    $q        = sanitize($_POST['query']);
                    $cars     = $cars->searchaboutcar($q);
                    if(empty($cars))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['NO_CARS']."</th></tr>";
                    }else{
                        echo ' 
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="wider_col"><span>'.$lang['CAR'].'</span> </th>
                                    <th><span>'.$lang['CAR_PROJECT'].'</span> </th>
                                    <th> <span>'.$lang['CAR_SUPERVISOR'] .'</span></th>
                                    <th><span>'.$lang['ACOUNTER_NOW'].'</span></th>
                                    <th><span>'.$lang['AVERGE_KILO_FOR_MONTH'].'</span></th>
                                    <th> <span>'.$lang['KILO_COST'].'</span></th>
                                    <th></th>
                                </tr>
                            </thead>
                    <tbody>';
                        foreach($cars as $k => $u){
                            echo'<tr id=tr_'.$u['users_sn'].'>
                            <td class="contact_img">
                                <a href="car_dashboard.php?c='.$u['cars_sn'].'"><img class="" height="35" src="'.$path.$u['cars_photo'].'" alt="profile-pic"></a>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-md-8">
                                        <h6 class="contact_name">'.$u['cars_code'].' - '.'['.$u['cars_model'].']'.'</h6>
                                        <h6 class=""> '.$lang['CAR_MODEL'].' '.$u['cars_year'].'</h6>
                                        <h6 class="">'.$u['cars_plate_number'].'</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <div><i class="fa fa-circle success_status smaller_icon"></i></div>
                                        <div><i class="fa fa-file-invoice warning_status"></i></div>
                                        <div><i class="fa fa-wrench danger_status"></i></div>
                                    </div>
                                </div>
                            </td>
                            <td>'.get_data("projects","projects_name","projects_sn",$u['cars_project_id']).'</td>
                            <td>'.get_data("users","users_name","users_sn",$u['cars_supervisor_id']).'</td>
                            <td>
                                <div><i class="fa fa-location-arrow success_status"></i></div>
                                <div>155.654 <i class="fa fa-history success_status"></i></div>
                            </td>
                            <td class="warning_status">8500</td>
                            <td><span class="success_status">4.2</span>/4.5</td>
                            <td class="car_table_actions">
                                <i class="fa fa-location-arrow safe_status" data-toggle="modal" data-target="#gps_modal"></i>
                                <a href="./car_order.php?c='.$u['cars_sn'].'">
                                    <i class="fa fa-address-book safe_status"></i>
                                </a>
                                <a href="./add_expenses.php?c='.$u['cars_sn'].'">
                                    <i class="fa fa-money-bill safe_status"></i>
                                </a>
                            </td>
                        </tr><tbody>';}
                    }
                }
            break;
            case"damage":
                if($_POST)
                {
                    include("./inc/Classes/system-damages.php");
	                $_car_damage = new systemcar_damage();
                    $q           = sanitize($_POST['query']);
                    $car_damage  = $_car_damage->searchdamage($q);
                    if(empty($car_damage))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['NO_CHECKS']."</th></tr>";
                    }else{
                        echo'<thead>
                                <tr>
                                    <th></th>
                                    <th class="wider_col">'.$lang['CAR'].'</th>
                                    <th>'.$lang['DATE'].'</th>
                                    <th>'.$lang['START_CHECK_BY'].'</th>
                                    <th>'.$lang['DAMAGE_NUM'].'</th>
                                </tr>
                            </thead>
                            <tbody > 
                        ';
                        foreach($car_damage as $k => $u){
                            echo'<tr id=tr_'.$u['car_damage_sn'].'>
                                    <td class="contact_img">
                                        <img height="35" src="'.$path.get_data("cars","cars_photo","cars_sn",$u['car_damage_car_id']).'" alt="profile-pic">
                                    </td>
                                    <td>
                                        <h6 class="contact_name">'.get_data("cars","cars_code","cars_sn",$u['car_damage_car_id']).' - '.get_data("cars","cars_model","cars_sn",$u['car_damage_car_id']).'</h6>
                                        <h6 class="dodger-blue">'.$lang['CAR_MODEL'].'  '.get_data("cars","cars_year","cars_sn",$u['car_damage_car_id']).'</h6>
                                        <h6 class="tangerine">'.get_data("cars","cars_plate_number","cars_sn",$u['car_damage_car_id']).'</h6>
                                    </td>
                                    <td>
                                        <h6>'._date_format($u['car_damage_date']).'</h6>
                                        <!--<h6 class="time_direction">10:45 AM</h6> --!>
                                    </td>
                                    <td>'.get_data("users","users_name","users_sn",$u['car_damage_by']).'</td>
                                    <td>';
                                    if($group['check_item_list'] == 1 && (get_damage_memmbers($u['car_damage_car_id']) > 0)){
                                        echo '<a href="car_damage.php?c='.$u['car_damage_car_id'].'">'.get_damage_memmbers($u['car_damage_car_id']).'</a>';
                                    }else{
                                        echo get_damage_memmbers($u['car_damage_car_id']);
                                    }    
                                   echo'</td>
                                </tr>
                            ';
                            }
                    }
                }
            break;
            case"reminders":
                if($_POST)
                {
                    include("./inc/Classes/system-reminders.php");
	                $_reminders = new systemreminders();
                    $q          = sanitize($_POST['query']);
                    $reminders  = $_reminders->searchreminders_service($q);
                    if(empty($reminders))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['NO_REMINDERS']."</th></tr>";
                    }else{
                        echo'<thead>
                                <tr class="periwinkle-blue ">
                                    <td></td>
                                    <td>'.$lang['CAR'].'</td>
                                    <td>'.$lang['RENEWS'].'</td>
                                    <td>'.$lang['NEXT_DO'].'</td>
                                    <td>'.$lang['KHWON_THAT'].'</td>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        foreach($reminders as $k => $u){
                            echo '<tr>
                                <td class="contact_img">
                                    <a href="./reminders_view.php?r='.$u['reminders_car_id'].'"><img height="35" src="'.$path.get_data('cars','cars_photo','cars_sn',$u['reminders_car_id']).'" alt="bus-pic"></a>
                                </td>
                                <td>
                                    <a href="./reminders_view.php?r='.$u['reminders_car_id'].'">
                                        '.get_car_datails($u['reminders_car_id']).'
                                    </a>
                                </td>
                                <td>'.reminder_service_number($u['reminders_car_id']).'</td>
                                <td>
                                    <span class="danger_status">
                                        <div>منذ 3 شهور</div>
                                        <div>منذ 2,000 كم</div>
                                        <b> لا تعمل </b>
                                    </span>
                                </td>
                                <td>
                                    <span>';
                                        if(is_array(get_reminders_memmbers($u['reminders_sn'])))
                                           {
                                               foreach(get_reminders_memmbers($u['reminders_sn']) as $k => $v){
                                                    echo '<div>'.$v['users_name'].'</div>';
                                                }   
                                           }else{
                                               echo get_reminders_memmbers($u['reminders_sn']);
                                           }

                                echo'</span>
                                </td>
                            </tr>';
                        }
                    }
                }
            break;  
            case"reminders_doc":
                if($_POST)
                {
                    include("./inc/Classes/system-reminders.php");
	                $_reminders = new systemreminders();
                    $q          = sanitize($_POST['query']);
                    $reminders  = $_reminders->searchreminders_doc($q);
                    if(empty($reminders))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['NO_REMINDERS']."</th></tr>";
                    }else{
                        echo'<thead>
                                <tr class="periwinkle-blue ">
                                    <td></td>
                                    <td>'.$lang['CAR'].'</td>
                                    <td>'.$lang['RENEWS'].'</td>
                                    <td>'.$lang['NEXT_DO'].'</td>
                                    <td>'.$lang['KHWON_THAT'].'</td>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        foreach($reminders as $k => $u){
                            echo '<tr>
                                <td class="contact_img">
                                    <a href="./reminders_view.php?r='.$u['reminders_car_id'].'"><img height="35" src="'.$path.get_data('cars','cars_photo','cars_sn',$u['reminders_car_id']).'" alt="bus-pic"></a>
                                </td>
                                <td>
                                    <a href="./reminders_view.php?r='.$u['reminders_car_id'].'">
                                        '.get_car_datails($u['reminders_car_id']).'
                                    </a>
                                </td>
                                <td>'.reminder_doc_number($u['reminders_car_id']).'</td>
                                <td>
                                    <span class="danger_status">
                                        <div>منذ 3 شهور</div>
                                        <div>منذ 2,000 كم</div>
                                        <b> لا تعمل </b>
                                    </span>
                                </td>
                                <td>
                                    <span>';
                                        if(is_array(get_reminders_memmbers($u['reminders_sn'])))
                                           {
                                               foreach(get_reminders_memmbers($u['reminders_sn']) as $k => $v){
                                                    echo '<div>'.$v['users_name'].'</div>';
                                                }   
                                           }else{
                                               echo get_reminders_memmbers($u['reminders_sn']);
                                           }
                                echo'</span>
                                </td>
                            </tr>';
                        }
                    }
                }
            break; 
                
            case"job_orders":
                if($_POST)
                {
                    include("./inc/Classes/system-job_orders.php");
	                $job_orders   = new systemjob_orders();
                    $q            = sanitize($_POST['query']);
                    $_job_orders  = $job_orders->getsitejob_orderssearch($q);
                    if(empty($_job_orders))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['NO_JOB_ORDERS']."</th></tr>";
                    }else{
                        echo'<thead>
                                <tr class="periwinkle-blue ">
                                    <td>'.$lang['JOB_ORDER_NUM'].'</td>
                                    <td></td>
                                    <td>'.$lang['CAR'].'</td>
                                    <td>'.$lang['DATE_IN'].'</td>
                                    <td>'.$lang['DATE_OUT'].'</td>
                                    <td>'.$lang['JOB_ORDER_COST'].'</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                        foreach($_job_orders as $k => $u){
                            echo'<tr id=tr_'.$u['job_orders_sn'].'>
                                    <td class="dodger-blue">'.$u['job_orders_sn'].'</td>
                                    <td class="contact_img">
                                        <img height="35" src='.$path.get_data('cars','cars_photo','cars_sn',$u['job_orders_car_id']).' alt="bus-pic">
                                    </td>
                                    <td>
                                        '.get_car_datails($u['job_orders_car_id']).'
                                    </td>
                                    <td>'._date_format($u['job_orders_date_in']).'</td>
                                    <td>'._date_format($u['job_orders_date_expect']).'</td>
                                    <td>'.($u['job_orders_total_fix'] + $u['job_orders_total_price'] - $u['job_orders_discount']+$u['job_orders_extra']).'</td>
                                    <td>';
                                    if($group['job_orders_edit'] == 1)
                                      {
                                          echo '<a href="./job_orders-addWorkOrder.html"><i class="far fa-edit darkish-green"></i></a>';
                                      }
                                    if($group['job_orders_delete'] == 1)
                                      {
                                          echo '<i class="fas fa-trash rose ml-2" data-toggle="modal" data-target="#Delete_'.$u['job_orders_sn'].'"></i>';
                                      }																	  
                                    echo'</td>
                                    </tr>
                                    <!-- confirm delete Modal -->
                                    <div class="modal fade addModal" id="Delete_'.$u['job_orders_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                            <div class="modal-content dark_bg">
                                                <div class="modal-body">
                                                    <h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
                                                </div>
                                                <div class="modal-footer" id="item_'.$k.'">
                                                    <button type="button" id="item_'.$u['job_orders_sn'].'" class="btn _btn  btn-light   delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
                                                    <button type="button" class="btn _btn btn-danger rose-bg" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                        }

                    }
                }
            break; 
            case"fuel":
                if($_POST)
                {
                    include("./inc/Classes/system-car_fuel.php");
	                $car_fuel   = new systemcar_fuel();
                    $q          = sanitize($_POST['query']);
                    $_car_fuel  = $car_fuel->searchcar_fuel($q);
                    if(empty($_car_fuel))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['NO_CAR_FUEL']."</th></tr>";
                    }else
                    {
                        echo'
                        <thead>
                            <tr>
                                <th></th>
                                <th>'.$lang['CAR'].'</th>
                                <th> '.$lang['PREVIOUS_READ'].'</th>
                                <th> '.$lang['NOW_READ'].'</th>
                                <th> '.$lang['DEFERENCE'].'</th>
                                <th> '.$lang['EXPECT_LITER'].'</th>
                                <th> '.$lang['SYS_FUEL_TYPE'].'</th>
                                <th> '.$lang['LITER_C'].'</th>
                                <th> '.$lang['LITER_COST'].'</th>
                                <th> '.$lang['FOR_K_M'].'</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($_car_fuel as $k => $u){
                            echo '<tr class="tr_collapse" data-toggle="collapse" data-target=".order_'.($k).'">
                                    <td colspan="4">
                                        <p class="small_title">'.day_name($u['date'] , 'D').' : '._date_format($u['date']).' '.'<i class="fa fa-arrow-down"></i></p>
                                    </td>
                                    <td>
                                        <p class="bold mb-0">'.($u['now'] - $u['previous']).'</p>
                                    </td>
                                    <td>
                                        <p class="bold dodger-blue mb-0">127.25</p>
                                        <p class="bold dodger-blue  mb-0">860</p>
                                    </td>
                                    <td></td>
                                    <td>'.$u['amount'].'</td>
                                    <td>
                                        <p class="mb-0">'.$u['cost'].'<i class="fas fa-circle danger_status ml-5"></i></p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            ';
                            get_day_fuel($u['date'],($k));
                        }


                    }
                }
            break;  
            case"users":
                if($_POST)
                {
                    include("./inc/Classes/system-users.php");
	                $_users = new systemusers();
                    $q      = sanitize($_POST['query']);
                    $users  = $_users->searchusers($q);
                    if(empty($users))
                    {
                        echo "<tr><th colspan=\"5\">".$lang['US_NO_USERS']."</th></tr>";
                    }else{
                        echo '
                        <thead>
                            <tr>
                                <th></th>
                                <th class="wide_col">'.$lang['US_NAME'].'</th>
                                <th>'.$lang['GROUP'].'</th>
                                <th>'.$lang['JOB'].'</th>
                                <th>'.$lang['PROJECT'].'</th>
                                <th>'.$lang['CAR'].'</th>
                                <th>'.$lang['PHONE'].'</th>
                                <th>'.$lang['US_LAST_LOGIN'].'</th>
                                <th>'.$lang['SETTINGS'].'</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach($users as $k => $u){
                            echo'<tr id=tr_'.$u['users_sn'].'>
                                <td class="contact_img">
                                        <img class="rounded-circle" height="35" src="'.$path.$u['users_photo'].'" alt="profile-pic">
                                </td>
                                <td>
                                    <h6 class="contact_name">'.$u['users_name'].'</h6>
                                    <h6 class="tangerine">'.$u['users_job_serial'].'</h6>
                                </td>
                                <td>'
                                    .get_data("groups","groups_name","groups_sn",$u['users_group_id']).
                                '</td>
                                <td>'
                                    .get_data("job_type","job_type_name","job_type_sn",$u['users_job_id']).
                                '</td>
                                <td>'
                                    .get_data("projects","projects_name","projects_manger_id",$u['users_sn']).
                                '</td>
                                ';
                                    if(get_data("cars","cars_code","cars_supervisor_id",$u['users_sn']) != $lang['NOT_FOUND'])
                                    {
                                       echo'<td class="dodger-blue">
                                        '.$lang['US_CODE'].get_data("cars","cars_code","cars_supervisor_id",$u['users_sn']).'
                                        </td>';
                                    }else{
                                        echo'<td>
                                        '.get_data("cars","cars_code","cars_supervisor_id",$u['users_sn']).'
                                        </td>';
                                    }
                                echo'
                                <td>'
                                    .$u['users_phone'].
                                '</td>  
                                <td>';
                                    if($u['users_last_login'] == "0000-00-00")
                                    { 
                                        echo "00/00/0000";
                                    }else{
                                       echo _date_format($u['users_last_login']);
                                    }
                                echo'</td>
                                <td>';
                                if($group['contacts_edit'] == 1)
                                {
                                   echo '<a href="./edit_user.php?id='.$u['users_sn'].'"><i class="far fa-edit darkish-green"></i></a>';
                                }
                                if($group['contacts_delete'] == 1)
                                {

                                    echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Delete_'.$u['users_sn'].'"></i>';
                                }
                                echo '
                                </td>
                                </tr>
                                <!-- confirm delete Modal -->
                                <div class="modal fade addModal" id="Delete_'.$u['users_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                        <div class="modal-content dark_bg">

                                            <div class="modal-body">
                                                <h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
                                            </div>
                                            <div class="modal-footer" id="item_'.$k.'">
                                                <button type="button" id="item_'.$u['users_sn'].'" class="btn _btn btn-danger rose-bg  delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
                                                <button type="button" class="btn _btn btn-light" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <tbody>
                            ';

                        }
                    }
                }
            break;    
 	
        }
    }
?>



