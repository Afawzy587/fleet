<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-car_fuel.php");
	$car_fuel = new systemcar_fuel();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['car_fuel_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                include("./inc/Classes/pager.class.php");
                $page;
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $car_fuel->getTotalcar_fuel();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"fuel.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $car_fuel       = $car_fuel->getsitecar_fuel($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"car_fuel",
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
                <h1 class="h2"><?php echo $lang['FUEL'];?></h1>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button class="btn dark_btn">
                        <a href="./add_fuel.php"><?php echo $lang['ADD_CAR_FUEL'];?></a>
                    </button>
                </div>
            </div>

        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <div class="row ">
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
                        <div class="col-md-7 mt-3 flex_items">
                            <span class="mr-2">
                                في الفترة من
                            </span>
                            <span>
                                <input id="datepicker1" width="100%" required name="startdate1"
                                    onchange="changeTableFromdate(this, 'fuel_table')" />
                            </span>
                            <span class="m-3">
                                ألى
                            </span>
                            <span>
                                <input id="datepicker2" width="100%" required name="enddate"
                                    onchange="changeTableTodate(this, 'fuel_table')" />
                            </span>

                        </div>
                        <div class="col-md-2 mt-3">
                            <p class="bold">إجمالي تكلفة الخدمة : <span>4,500</span></p>
                            <p class="bold">إجمالي عدد اللترات : <span>4,500</span></p>
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
                    <table class="table  white-bg fuel_table searchTable" id="fuel_table">


                        <thead>
                            <tr>
                                <th></th>
                                <th>السيارة</th>
                                <th>قراءة سابقة</th>
                                <th>قراءة حالية</th>
                                <th>الفرق</th>
                                <th>توقع لتر/ قيمة</th>
                                <th>نوع الوقود</th>
                                <th>الكمية (لتر)</th>
                                <th>القيمة (ج.م)</th>
                                <th>مرجع(كم/ل)</th>
                                <th></th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr_collapse" data-toggle="collapse" data-target=".order1">
                                <td colspan="4">
                                    <p class="small_title">الأثنين: 16 /10 / 2020 <i class="fa fa-arrow-down"></i></p>
                                </td>
                                <!-- <td></td> -->
                                <td>
                                    <p class="bold mb-0">700</p>
                                </td>
                                <td>
                                    <p class="bold dodger-blue mb-0">127.25</p>
                                    <p class="bold dodger-blue  mb-0">860</p>
                                </td>
                                <td>135</td>
                                <td>
                                    <p class="mb-0">912<i class="fas fa-circle danger_status ml-5"></i></p>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="mr-3">
                                        <i class="far fa-edit darkish-green"></i>
                                    </a>

                                    <i class="fas fa-trash rose" data-toggle="modal"
                                        data-target="#Deleteconfirmation"></i>
                                </td>
                            </tr>
                            <tr class="collapse order1 show">
                                <td class="contact_img">
                                    <img height="35" src="images/bus_image.jpg" alt="profile-pic">
                                </td>
                                <td>
                                    <h6 class="contact_name">104 - [Toyota Coaster]</h6>
                                    <h6 class="dodger-blue">موديل 2018</h6>
                                    <h6 class="tangerine">ق أ س 1234</h6>
                                </td>
                                <td>
                                    <h6>112,000</h6>
                                </td>
                                <td>
                                    <h6>113,000</h6>
                                </td>
                                <td>550</td>
                                <td>
                                    <p class=" dodger-blue mb-0">127.25</p>
                                    <p class=" dodger-blue  mb-0">860</p>
                                </td>
                                <td>سولار</td>
                                <td>35</td>
                                <td>
                                    <p class="mb-0">245<i class="fas fa-circle success_status ml-5"></i></p>
                                </td>
                                <td>
                                    <p class=" dodger-blue  mb-0">5.5</p>
                                </td>
                                <td>
                                    <a href="" class="mr-3">
                                        <i class="far fa-edit darkish-green"></i>
                                    </a>

                                    <i class="fas fa-trash rose" data-toggle="modal"
                                        data-target="#Deleteconfirmation"></i>
                                </td>

                            </tr>
                            <tr class="collapse order1 show">
                                <td class="contact_img">
                                    <img height="35" src="images/bus_image.jpg" alt="profile-pic">
                                </td>
                                <td>
                                    <h6 class="contact_name">104 - [Toyota Coaster]</h6>
                                    <h6 class="dodger-blue">موديل 2018</h6>
                                    <h6 class="tangerine">ق أ س 1234</h6>
                                </td>
                                <td>
                                    <h6>112,000</h6>
                                </td>
                                <td>
                                    <h6>113,000</h6>
                                </td>
                                <td>200</td>
                                <td>
                                    <p class=" dodger-blue mb-0">127.25</p>
                                    <p class=" dodger-blue  mb-0">860</p>
                                </td>
                                <td>سولار</td>
                                <td>35</td>
                                <td>
                                    <p class="mb-0">245<i class="fas fa-circle success_status ml-5"></i></p>
                                </td>
                                <td>
                                    <p class=" dodger-blue  mb-0">5.5</p>
                                </td>
                                <td>
                                    <a href="" class="mr-3">
                                        <i class="far fa-edit darkish-green"></i>
                                    </a>

                                    <i class="fas fa-trash rose" data-toggle="modal"
                                        data-target="#Deleteconfirmation"></i>
                                </td>

                            </tr>
                            <tr class="tr_collapse" data-toggle="collapse" data-target=".order2">
                                <td colspan="4">
                                    <p class="small_title">الأثنين: 16 /10 / 2020 <i class="fa fa-arrow-down"></i></p>
                                </td>
                                <!-- <td></td> -->
                                <td>
                                    <p class="bold mb-0">700</p>
                                </td>
                                <td>
                                    <p class="bold dodger-blue mb-0">127.25</p>
                                    <p class="bold dodger-blue  mb-0">860</p>
                                </td>
                                <td>135</td>
                                <td>
                                    <p class="mb-0">912<i class="fas fa-circle danger_status ml-5"></i></p>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="mr-3">
                                        <i class="far fa-edit darkish-green"></i>
                                    </a>

                                    <i class="fas fa-trash rose" data-toggle="modal"
                                        data-target="#Deleteconfirmation"></i>
                                </td>
                            </tr>
                            <tr class="collapse order2">
                                <td class="contact_img">
                                    <img height="35" src="images/bus_image.jpg" alt="profile-pic">
                                </td>
                                <td>
                                    <h6 class="contact_name">104 - [Toyota Coaster]</h6>
                                    <h6 class="dodger-blue">موديل 2018</h6>
                                    <h6 class="tangerine">ق أ س 1234</h6>
                                </td>
                                <td>
                                    <h6>112,000</h6>
                                </td>
                                <td>
                                    <h6>113,000</h6>
                                </td>
                                <td>200</td>
                                <td>
                                    <p class=" dodger-blue mb-0">127.25</p>
                                    <p class=" dodger-blue  mb-0">860</p>
                                </td>
                                <td>سولار</td>
                                <td>35</td>
                                <td>
                                    <p class="mb-0">245<i class="fas fa-circle success_status ml-5"></i></p>
                                </td>
                                <td>
                                    <p class=" dodger-blue  mb-0">5.5</p>
                                </td>
                                <td>
                                    <a href="" class="mr-3">
                                        <i class="far fa-edit darkish-green"></i>
                                    </a>

                                    <i class="fas fa-trash rose" data-toggle="modal"
                                        data-target="#Deleteconfirmation"></i>
                                </td>

                            </tr>
                            <tr class="collapse order2">
                                <td class="contact_img">
                                    <img height="35" src="images/bus_image.jpg" alt="profile-pic">
                                </td>
                                <td>
                                    <h6 class="contact_name">104 - [Toyota Coaster]</h6>
                                    <h6 class="dodger-blue">موديل 2018</h6>
                                    <h6 class="tangerine">ق أ س 1234</h6>
                                </td>
                                <td>
                                    <h6>112,000</h6>
                                </td>
                                <td>
                                    <h6>113,000</h6>
                                </td>
                                <td>800</td>
                                <td>
                                    <p class=" dodger-blue mb-0">127.25</p>
                                    <p class=" dodger-blue  mb-0">900</p>
                                </td>
                                <td>بنزين</td>
                                <td>20</td>
                                <td>
                                    <p class="mb-0">245<i class="fas fa-circle success_status ml-5"></i></p>
                                </td>
                                <td>
                                    <p class=" dodger-blue  mb-0">5.5</p>
                                </td>
                                <td>
                                    <a href="" class="mr-3">
                                        <i class="far fa-edit darkish-green"></i>
                                    </a>

                                    <i class="fas fa-trash rose" data-toggle="modal"
                                        data-target="#Deleteconfirmation"></i>
                                </td>

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
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
