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
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['projects_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                include("./inc/Classes/pager.class.php");
                $page;
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $projects->getTotalprojects();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"projects.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $_projects   = $projects->getsiteprojects($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"projects",
                            "mode" 		        => 	"list",
                            "total" 		    => 	$total,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
    <main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"> <?php echo $lang['PROJECTS'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong>  <?php echo $lang['PROJECTS_LIST'];?></h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <?php
                            if($group['projects_add'] == 1)
                            {
                                echo '<button class="btn dark_btn"><a href="./add_project.php">'.$lang['ADD_PROJECT'].'</a></button>';
                            }
                        ?>
                </div>
            </div>
        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <input type="hidden" value="projects" id="table">
                       <input type="hidden" value="projects_delete" id="permission">
                        <table class="table  white-bg  table-hover" id="table-id" >
                            <?php  if(empty($_projects))
                                    {
                                        echo "<tr><th colspan=\"5\">".$lang['NO_CHECKS']."</th></tr>";
                                    }else{
                                        echo'<thead>
                                                <tr class="periwinkle-blue">
                                                    <td>'.$lang['NAME'].'</td>
                                                    <td>'.$lang['P_SUPER'].'</td>
                                                    <td>'.$lang['P_CLIENT_REP'].'</td>
                                                    <td>'.$lang['P_CAR_NUM'].'</td>
                                                    <td>'.$lang['P_CAR_LOIN'].'</td>
                                                    <td>'.$lang['P_CAR_TOTAL'].'</td>
                                                    <td>'.$lang['P_KILO_LITER'].'</td>
                                                    <td>'.$lang['P_CLIENT_PHONE'].'</td>
                                                    <td>'.$lang['CONTRACT_DATE'].'</td>
                                                    <td>'.$lang['P_END_IN'].'</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody > 
                                        ';
                                        foreach($_projects as $k => $u){
                                            echo'<tr id=tr_'.$u['projects_sn'].'>
                                                    <td class="dodger-blue"><a href="./project_dashboard.php?p='.$u['projects_sn'].'">'.$u['projects_name'].'</a></td>
                                                    <td>'.get_data("users","users_name","users_sn",$u['projects_manger_id']).'</td>
                                                    <td>'.$u['projects_client'].'</td>
                                                    <td>'.project_car_own($u['projects_sn']).'</td>
                                                    <td>'.project_car_loin($u['projects_sn']).'</td>
                                                    <td>'.(project_car_loin($u['projects_sn'])+project_car_own($u['projects_sn'])).'</td>
                                                    <td>لا يعمل</td>
                                                    <td>'.$u['projects_client_phone'].'</td>
                                                    <td>'._date_format($u['projects_contract_start']).'</td>
                                                    <td>'._date_format($u['projects_contract_end']).'</td>
                                                    <td>
                                                       <i class="fas fa-chart-bar dodger-blue" data-toggle="modal" data-target="#project_'.$u['projects_sn'].'"></i>
                                                    </td>
                                                    <td>
                                                        <i class="fas fa-trash rose ml-2" data-toggle="modal" data-target="#Delete_'.$u['projects_sn'].'"></i>
                                                    </td>
                                                </tr>
                                                <!-- confirm delete Modal -->
                                                <div class="modal fade addModal" id="Delete_'.$u['projects_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                                        <div class="modal-content dark_bg">

                                                            <div class="modal-body">
                                                                <h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
                                                            </div>
                                                            <div class="modal-footer" id="item_'.$k.'">
                                                                <button type="button" id="item_'.$u['projects_sn'].'" class="btn _btn btn-danger rose-bg  delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
                                                                <button type="button" class="btn _btn btn-light" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal -->
                                                    <div class="modal fade" id="project_'.$u['projects_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                            <div class="modal-content modal_grey_bg">

                                                                <div class="modal-body white-bg chart_wrapper">
                                                                    <div class="chart_header">
                                                                        <h6 class="bold">كم شهري</h6>
                                                                        <div class="date_range">
                                                                            <p>في الفترة من</p>
                                                                            <span class="date_input">
                                                                                <input id="datepicker1" width="100%"
                                                                                    onchange="update_barChart_startdate(""kmlog_chart",this)" />
                                                                            </span>
                                                                            <p>الي</p>
                                                                            <span class="date_input">
                                                                                <input id="datepicker2" width="100%"
                                                                                    onchange="update_barChart_enddate("kmlog_chart", this)" />
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chart_body">
                                                                        <canvas id="monthly_kmLog" width="100%"></canvas>
                                                                    </div>
                                                                    <div class="chart_info">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <p>متوسط كم شهري فعلي : <span class="safe_status">8521</span></p>
                                                                                <p>الحد الأقصي للكيلومتر شهرياً : <span>4984</span></p>
                                                                            </div>
                                                                            <div class="col-md-4 modal_view_option">
                                                                                <div class="form-group">
                                                                                    <label>العرض</label>
                                                                                    <select name="" id="" class="md-select" name="view_option"
                                                                                    onchange="update_barChart_view("kmlog_chart", this)"   >
                                                                                        <option value="month">شهر </option>
                                                                                        <option value="year">سنة</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body white-bg chart_wrapper">
                                                                    <div class="chart_header">
                                                                        <h6 class="bold">كم شهري</h6>
                                                                        <div class="date_range">
                                                                            <p>في الفترة من</p>
                                                                            <span class="date_input">
                                                                                <input id="datepicker3" width="100%"
                                                                                    onchange="update_barChart_startdate("kmCostlog_chart",this)" />
                                                                            </span>
                                                                            <p>الي</p>
                                                                            <span class="date_input">
                                                                                <input id="datepicker4" width="100%"
                                                                                    onchange="update_barChart_enddate("kmCostlog_chart", this)" />
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chart_body">
                                                                        <canvas id="monthly_kmCostlog" width="100%"></canvas>
                                                                    </div>
                                                                    <div class="chart_info">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <p>متوسط كم شهري فعلي : <span class="safe_status">8521</span></p>
                                                                                <p>الحد الأقصي للكيلومتر شهرياً : <span>4984</span></p>
                                                                            </div>
                                                                            <div class="col-md-4 modal_view_option">
                                                                                <div class="form-group">
                                                                                    <label>العرض</label>
                                                                                    <select name="" id="" class="md-select" name="view_option"
                                                                                    onchange="update_barChart_view("kmCostlog_chart", this)"   >
                                                                                        <option value="month">شهر </option>
                                                                                        <option value="year">سنة</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body white-bg chart_wrapper">
                                                                    <div class="chart_header">
                                                                        <h6 class="bold">كم شهري</h6>
                                                                        <div class="date_range">
                                                                            <p>في الفترة من</p>
                                                                            <span class="date_input">
                                                                                <input id="datepicker5" width="100%"
                                                                                    onchange="update_barChart_startdate(\'fuellog_chart\',this)" />
                                                                            </span>
                                                                            <p>الي</p>
                                                                            <span class="date_input">
                                                                                <input id="datepicker6" width="100%"
                                                                                    onchange="update_barChart_enddate(\'fuellog_chart\', this)" />
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="chart_body">
                                                                        <canvas id="fuellog" width="100%"></canvas>
                                                                    </div>
                                                                    <div class="chart_info">
                                                                        <div class="row ">
                                                                            <div class="col-md-6">
                                                                                <p>متوسط كم شهري فعلي : <span class="safe_status">8521</span></p>
                                                                                <p>الحد الأقصي للكيلومتر شهرياً : <span>4984</span></p>
                                                                            </div>
                                                                            <div class="col-md-4 modal_view_option">
                                                                                <div class="form-group">
                                                                                    <label>العرض</label>
                                                                                    <select name="" id="" class="md-select" name="view_option"
                                                                                    onchange="update_barChart_view(\'fuellog_chart\', this)"   >
                                                                                        <option value="month">شهر </option>
                                                                                        <option value="year">سنة</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer actions">
                                                                     <i class="fa fa-file-pdf white"></i>
                                                                     <i class="fa fa-print white"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
<script src="./assets/js/projects_charts.js"></script>
