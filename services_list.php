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
                <h1 class="h2"> خدمات الصيانة</h1>
                <h4 class="sub_title">
                    <strong> &gt; </strong> سجل الخدمة</h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button class="btn dark_btn">
                        <a href="./">أضف أمر شغل</a>
                    </button>
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
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="previousIssue">
                                <div class="row flex_items">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-lg search_bar">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                            <input class="form-control search_bar" type="search" id="search_input_all"
                                                onkeyup="FilterkeyWord_all_table()" placeholder="البحث">
                                        </div>
                                    </div>
                                    <div class="col-md-6 flex_items">
                                        <span class="mr-2">
                                            في الفترة من
                                        </span>
                                        <span>
                                            <input id="datepicker1" width="100%" required name="startdate1"
                                                onchange="changeTableFromdate(this, 'service_log')" />
                                        </span>
                                        <span class="m-3">
                                            ألى
                                        </span>
                                        <span>
                                            <input id="datepicker2" width="100%" required name="enddate"
                                                onchange="changeTableTodate(this, 'service_log')" />
                                        </span>

                                    </div>
                                    <div class="col-md-3">
                                        <p class="bold">إجمالي تكلفة الخدمة : <span>4,500</span></p>
                                    </div>
                                </div>

                                <div class="num_rows" style="display: none;">

                                    <div class="form-group">
                                        <!--		Show Numbers Of Rows 		-->
                                        <select class="form-control" name="state" id="maxRows">
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                </div>
                                <table class="table white-bg  table-hover table-responsive-md searchTable" id="service_log">


                                    <thead>
                                        <tr class="periwinkle-blue ">
                                            <td></td>
                                            <td>السيارة</td>
                                            <td>زمن و كم اكتمال اخر خدمة</td>
                                            <td>عدد أوامر الشغل لآخر خدمة مكتملة</td>
                                            <td>تكلفة آخر خدمة</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="contact_img">
                                                <img height="35" src="images/bus_image.jpg"
                                                    alt="bus-pic">
                                            </td>
                                            <td>
                                                <h6 class="contact_name">104 - [Toyota Coaster]</h6>
                                                <h6 class="dodger-blue">موديل 2018</h6>
                                                <h6 class="tangerine">ق أ س 1234</h6>
                                            </td>
                                            <td>
                                                <div>منذ 3 شهور</div>
                                                <div>منذ 2,000 كم</div>
                                            </td>
                                            <td>1</td>
                                            <td>2,500</td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="contact_img">
                                                <img height="35" src="images/bus_image.jpg"
                                                    alt="bus-pic">
                                            </td>
                                            <td>
                                                <h6 class="contact_name">200 - [Toyota Coaster]</h6>
                                                <h6 class="dodger-blue">موديل 2018</h6>
                                                <h6 class="tangerine">ق أ س 1234</h6>
                                            </td>
                                            <td>
                                                <div>منذ 3 شهور</div>
                                                <div>منذ 2,000 كم</div>
                                            </td>
                                            <td>1</td>
                                            <td>2,500</td>
                                   
                                        </tr>
                                        <tr>
                                            <td class="contact_img">
                                                <img height="35" src="images/bus_image.jpg"
                                                    alt="bus-pic">
                                            </td>
                                            <td>
                                                <h6 class="contact_name">250 - [Toyota Coaster]</h6>
                                                <h6 class="dodger-blue">موديل 2018</h6>
                                                <h6 class="tangerine">ق أ س 1234</h6>
                                            </td>
                                            <td>
                                                <div>منذ 5 شهور</div>
                                                <div>منذ 2,000 كم</div>
                                            </td>
                                            <td>1</td>
                                            <td>2,500</td>
                                   
                                        </tr>

                                    <tbody>
                                </table>

                                <!--		Start Pagination -->
                                <div class='pull-left pagination-container'>
                                    <nav>
                                        <ul class="pagination">
                                            <!--	Here the JS Function Will Add the Rows -->
                                        </ul>
                                    </nav>
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