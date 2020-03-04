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
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['check_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                include("./inc/Classes/pager.class.php");
                $page;
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $car_damage->getTotalcar_damage();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"damages.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $car_damage   = $car_damage->getsitecar_damage($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"car_damage",
                            "mode" 		        => 	"list",
                            "total" 		    => 	$total,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
//                    if($_GET['message']== "update")
//                    {
//                      $message = $lang['edit_car_damage_success'];
//                    }elseif($_GET['message']== "add"){
//                      $message = $lang['add_car_damage_success'];
//                    }elseif($_GET['message']== "delete"){
//                      $message = $lang['delete_car_damage_success'];
//                    }
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
    <main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"> <?php echo $lang['CHECK'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong>  <?php echo $lang['CAR_DAMAGE'];?></h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                     <button class="btn dark_btn"><a href="./add_check.php"> <?php echo $lang['START_CHECK'];?></a></button>
                </div>
            </div>
        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <div class="input-group input-group-lg search_bar">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <!-- <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg"> -->
                            <input class="form-control search_bar" type="search" id="search_input_all"onkeyup="FilterkeyWord_all_table()" placeholder="<?php echo $lang['SEARCH'];?>">
                        </div>
                        
                        <table class="table table-class white-bg contacts_table table-hover" id="table-id" >
                            
                            <?php  if(empty($car_damage))
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
                            ?>
                            <tbody>
                        </table>
                        <!--		Start Pagination -->
                        <div class='pull-left pagination-container'>
                             <?php echo $pager;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
