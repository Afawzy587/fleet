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
        $mId  = intval($_GET['p']);
        if ($mId != 0)
        {
            if($group['projects_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $_project = $projects->getprojectsInformation($mId);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"projects",
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
                <h1 class="h2">  <?php  echo $lang['PROJECTS'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong> <?php  echo $lang['PROJECT_DASH'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <div class="container page_body">
                <div class="row white-bg blue_border flex_items_btween">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <p class="bold inline_item mr-5"> <?php  echo $lang['PROJECT_NAME'];?></p>
                                    <p class=" inline_item ml-5"><?php  echo $_project['projects_name'];?></p>
                                </div>
                                <div class="row">
                                    <p class="bold inline_item mr-5"><?php  echo $lang['P_SUPER'];?></p>
                                    <p class=" inline_item"><?php echo get_data("users","users_name","users_sn",$_project['projects_manger_id']);?></p>
                                </div>
                         
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <p class="bold inline_item mr-3"> <?php  echo $lang['SYS_TRANSFER'];?></p>
                                    <p class=" inline_item"><?php echo $_project['transfer_type_name'];?></p> 
                                </div>
                                <div class="row">
                                          <p class="bold inline_item mr-3"> <?php  echo $lang['P_CAR_NUM'];?></p>
                                <p class=" inline_item"><?php  echo $_project['project_car_types_car_number'];?></p>
                                </div>
                            
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                         <p class="bold inline_item mr-3"><?php  echo $lang['KILO_MONTH'];?></p>
                                <p class=" inline_item">لا يعمل</p>
                                </div>
                                <div class="row">
                                           <p class="bold inline_item mr-3"> <?php  echo $lang['PROJ_OWN'];?></p>
                                <p class=" inline_item"><?php echo project_car_own($_project['projects_sn']);?></p>
                                </div>
                           
                            </div>
                            <div class="col-md-2">
                                <div class="row">
                                         <p class="bold inline_item mr-3"><?php echo $lang['PROJ_ROADS'];?></p>
                                <p class=" inline_item"><?php  echo $_project['roadcount'];?></p> 
                                </div>
                          
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 flex_items actions topleft">
                        <i class="fa fa-file-pdf dodger-blue mr-3"></i>
                        <i class="fa fa-print dodger-blue mr-3"></i>
                        <a href="./projects-addProject.html" class="mr-3"><i class="far fa-edit darkish-green"></i></a>
                        <i class="fas fa-trash rose mr-3" data-toggle="modal" data-target="#Deleteconfirmation"></i>
                    </div>
                </div>
                <div class="row car_dashboard">
                    <div class="col">
                        <div class="row">
                            <div class="col" id="box">
                                <div class="row">
                                    <div class="col white-bg chart_wrapper">
                                        <div class="chart_header">
                                            <h6 class="bold">التكاليف</h6>
                                            <div class="date_range">
                                                <p>في الفترة من</p>
                                                <span class="date_input">
                                                    <input id="datepicker1" width="100%"
                                                        onchange="update_startdate('main_chart',this)" />
                                                </span>
                                                <p>الي</p>
                                                <span class="date_input">
                                                    <input id="datepicker2" width="100%"
                                                        onchange="update_enddate('main_chart', this)" />
                                                </span>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                        </div>
                                        <div class="chart_body">
                                            <canvas id="myChart" height="100px"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg chart_wrapper">
                                        <div class="chart_header">
                                            <h6 class="bold">سجل الوقود</h6>
                                            <div class="date_range">
                                                <p>في الفترة من</p>
                                                <span class="date_input">
                                                    <input id="datepicker3" width="100%"
                                                        onchange="update_lineChart_startdate('fuel_chart',this)" />
                                                </span>
                                                <p>الي</p>
                                                <span class="date_input">
                                                    <input id="datepicker4" width="100%"
                                                        onchange="update_lineChart_enddate('fuel_chart', this)" />
                                                </span>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                        </div>
                                        <div class="chart_body">
                                            <canvas id="fuelChart" height="300px"></canvas>
                                        </div>
                                        <div class="chart_info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="dodger-blue">نوع الوقود : سولار</p>
                                                    <p class="dodger-blue">سعر اللتر : 6.75</p>
                                                    <p class="dodger-blue">المعدل المعياري : 5.5 كم / لتر</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>تكلفة الوقود: 65,750</p>
                                                    <p>كمية الوقود: 9,741</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>كم افتراضي: 53,575.5</p>
                                                    <p>كم فعلي: <span class="darkish-green">54,000</span> </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg chart_wrapper">
                                        <div class="chart_header">
                                            <h6 class="bold">سجل خدمات الصيانة</h6>
                                            <div class="date_range">
                                                <p>في الفترة من</p>
                                                <span class="date_input">
                                                    <input id="datepicker5" width="100%"
                                                        onchange="update_lineChart_startdate('service_chart',this)" />
                                                </span>
                                                <p>الي</p>
                                                <span class="date_input">
                                                    <input id="datepicker6" width="100%"
                                                        onchange="update_lineChart_enddate('service_chart', this)" />
                                                </span>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                        </div>
                                        <div class="chart_body">
                                            <canvas id="serviceChart" height="300px"></canvas>
                                        </div>
                                        <div class="chart_info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p>عدد أوامر شغل الصيانة : 33</p>
                                                    <p>عدد أوامر توريد قطع الغيار : 15</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>تكلفة فنيين: 13,000</p>
                                                </div>
                                                <div class="col-md-4">
                                                    <p>تكلفة قطع غيار: 53,575</p>
                                                    <p>تكلفة خدمات الصيانة: 61,560</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg chart_wrapper">
                                        <div class="chart_header">
                                            <h6 class="bold">سجل مصروفات آخري</h6>
                                            <div class="date_range">
                                                <p>في الفترة من</p>
                                                <span class="date_input">
                                                    <input id="datepicker7" width="100%"
                                                        onchange="update_lineChart_startdate('expenses_chart', this)" />
                                                </span>
                                                <p>الي</p>
                                                <span class="date_input">
                                                    <input id="datepicker8" width="100%"
                                                        onchange="update_lineChart_enddate('expenses_chart', this)" />
                                                </span>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </div>
                                        </div>
                                        <div class="chart_body">
                                            <canvas id="expensesChart" height="300px"></canvas>
                                        </div>
                                        <div class="chart_info custom_chart_info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <p class="">عدد بيانات المصروفات : 16</p>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    <p>القيمة: 49,741</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
<script src="./assets/js/project-dashboard.js"></script>


