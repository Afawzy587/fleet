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
	$cars = new systemcars();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['cars_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                include("./inc/Classes/pager.class.php");
                $page;
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $cars->getTotalcars();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"cars.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $cars       = $cars->getsitecars($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"cars",
                            "mode" 		        => 	"list",
                            "total" 		    => 	$total,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
//                    if($_GET['message']== "update")
//                    {
//                      $message = $lang['edit_cars_success'];
//                    }elseif($_GET['message']== "add"){
//                      $message = $lang['add_cars_success'];
//                    }elseif($_GET['message']== "delete"){
//                      $message = $lang['delete_cars_success'];
//                    }
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
<main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h1 class="h2"><?php echo $lang['CARS'];?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                        <?php
                            if($group['cars_add'] == 1)
                            {
                                echo '<button class="btn dark_btn"><a href="./add_car.php">'.$lang['ADD_CAR'].'</a></button>';
                            }
                        ?>
                </div>
            </div>

        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <input type="hidden" value="cars" id="table">
                            <input type="hidden" value="contacts_delete" id="permission">
                            <div class="tab-pane active" id="previousIssue">
                                <div class="input-group input-group-lg search_bar">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input class="form-control search_bar" type="search" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="<?php echo $lang['SEARCH'];?>">
                                </div>
                                <table class="table table-class white-bg contacts_table table-hover tablesorter car_table" id="table-id">
                                   <?php  if(empty($cars))
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
                                        </tr>';}
                                    }?>
                                <tbody>
                                </table>
                                <!--		Start Pagination -->
                                <div class='pull-left pagination-container'>
                                    <?php echo $pager;?>
                                </div>
                                <!-- <div class="rows_count">Showing 11 to 20 of 91 entries</div> -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
<script>
        $(function () {
            $("#table-id").tablesorter();
        });
    </script>