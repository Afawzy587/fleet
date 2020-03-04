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
        $mId  = intval($_GET['c']);
        if ($mId != 0)
        {
            if($group['cars_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $_car = $cars->getcarsInformation($mId);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"cars",
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
                <h1 class="h2"><?php echo $lang['CARS'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong><?php echo $lang['CAR_DASHBOARD'];?></h4>
            </span>
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
                            <p><?php echo $lang['C_D_SUP'];?> </p>
                            <p class="safe_status"><?php echo get_data("users","users_name","users_sn",$_car['cars_supervisor_id'])?></p>
                        </div>
                    </div>
                    <div class="col-md-2 car_actions">
                        <?php if($group['cars_edit'] == 1)
                                {
                                    echo'<a href=""><i class="far fa-edit darkish-green"></i></a>';
                                }
                                
                                if($group['cars_delete'] == 1)
                                {
                                    echo'<i class="fas fa-trash rose" data-toggle="modal" data-target="#Deleteconfirmation"></i>';
                                }
                        ?>
                        

                        

                    </div>
                </div>

                <div class="row car_dashboard">
                    <div class="col">
<!--
                        <div class="row">
                            <div class="col-md-7" id="box">
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
                                            <canvas id="myChart"></canvas>
                                        </div>
                                    </div>
                                </div>
-->
<!--
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
                                            <canvas id="fuelChart"></canvas>
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
                                            <canvas id="serviceChart"></canvas>
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
                                            <canvas id="expensesChart"></canvas>
                                        </div>
                                        <div class="chart_info custom_chart_info">
                                            <div class="row">
                                                <div class="col">
                                                    <p class="dodger-blue">نوع الوقود : سولار</p>
                                                    <p>كمية الوقود: 9,741</p>
                                                    <a href="./fleet-expenses-add.html" class=" dark_btn btn ">اضافة مصروف</a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-5 dashboard_left_Side">
                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col-md-7">
                                                <table>
                                                    <tr>
                                                        <td>تكلفة الكيلومتر الفعلي</td>
                                                        <td class="safe_status value_bigger">4.2</td>
                                                    </tr>
                                                    <tr>
                                                        <td>تكلفة الكيلومتر الافتراضي</td>
                                                        <td class="value_bigger">4.5</td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-md-5 left_btn_wrapper"><button class="btn dark_btn"
                                                    width="100%" data-toggle="modal" data-target="#km_log">سجل
                                                    الكيلومتر</button></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col">
                                                <div class="row">
                                                    <table class="current_driver_info">
                                                        <thead class="table_head">
                                                            <td>السائق الحالي</td>
                                                            <td>خط السير</td>
                                                            <td>تسليم للسائق</td>
                                                            <td>استلام</td>

                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="">سائق 1</td>
                                                                <td class="">412</td>
                                                                <td class="">
                                                                    <div>11/2/2020</div>
                                                                    <div class="time_direction"> 9:30 PM</div>
                                                                </td>
                                                                <td class="">
                                                                    <div>11/2/2020</div>
                                                                    <div class="time_direction">11:30 PM</div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row ">
                                                    <div class="col left_btn_wrapper">
                                                        <a href="./fleet-assign-from-driver.html" class="btn dark_btn" width="100%">استلام الآن</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col">
                                                <div class="row ">
                                                    <div class="col">
                                                        <p class="small_title">الأعطال</p>
                                                    </div>
                                                    <div class="col left_btn_wrapper">
                                                        <button class="btn dark_btn" width="100%">إضافة عطل</button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <table class="issues_table table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="">
                                                                    <div class="mb-2 cool-grey warning_status">1</div>
                                                                    <div>مفتوح</div>
                                                                </td>
                                                                <td class="separator_wrapper">
                                                                    <hr>

                                                                </td>
                                                                <td class="">
                                                                    <div class="mb-2 cool-grey">0</div>
                                                                    <div>متأخر</div>
                                                                </td>

                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row isuue_item">
                                                    <div class="col">
                                                        <p class="warning_status">أنوار الفرامل</p>
                                                        <ul class="issue_details_list">
                                                            <li>
                                                                <p>إبلاغ العطل في:</p>
                                                                <p class="warning_status">12/2/2020</p>
                                                            </li>
                                                            <li>
                                                                <p>بواسطة:</p>
                                                                <p class="warning_status">أحمد محمد</p>
                                                            </li>
                                                            <li>
                                                                <p>وصف العطل:</p>
                                                                <p class="warning_status">أنوار الفرامل من الجنب الأيمن
                                                                    لا تعمل</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col">
                                                <div class="row ">
                                                    <div class="col">
                                                        <p class="small_title">تذكير خدمة الصيانة</p>
                                                    </div>
                                                    <div class="col left_btn_wrapper">
                                                        <button class="btn dark_btn" width="100%">إضافة تذكير</button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <table class="issues_table table services_table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="">
                                                                    <div>
                                                                        <div class="mb-2 cool-grey warning_status">1
                                                                        </div>
                                                                        <div class=" warning_status">ينتهي قريباً</div>
                                                                    </div>
                                                                </td>
                                                                <td class="separator_wrapper">
                                                                    <hr>
                                                                </td>
                                                                <td class="">
                                                                    <div>
                                                                        <div class="mb-2 cool-grey danger_status">0
                                                                        </div>
                                                                        <div class="danger_status">متأخر</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row isuue_item">
                                                    <div class="col">
                                                        <span class="flex_items">
                                                            <p class="warning_status">تغيير زيت المحرك</p>
                                                            <p class="bottom_text_line">بعد 1 شهر و <span
                                                                    class="warning_status">3</span>أيام و <span
                                                                    class="warning_status">5650</span> كيلومتر من الآن
                                                            </p>
                                                        </span>
                                                        <span class="flex_items">
                                                            <p class="safe_status">تغيير زيت المحرك</p>
                                                            <p class="bottom_text_line">بعد 3 شهور و <span
                                                                    class="safe_status">3</span>أيام و <span
                                                                    class="safe_status">8460</span> كيلومتر من الآن</p>
                                                        </span>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col">
                                                <div class="row ">
                                                    <div class="col">
                                                        <p class="small_title">تذكير تجديدات الوثائق</p>
                                                    </div>
                                                    <div class="col left_btn_wrapper">
                                                        <button class="btn dark_btn" width="100%">إضافة تذكير</button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <table class="issues_table table services_table">
                                                        <tbody>
                                                            <tr>
                                                                <td class="">
                                                                    <div>
                                                                        <div class="mb-2 cool-grey warning_status">1
                                                                        </div>
                                                                        <div class=" warning_status">ينتهي قريباً</div>
                                                                    </div>
                                                                </td>
                                                                <td class="separator_wrapper">
                                                                    <hr>
                                                                </td>
                                                                <td class="">
                                                                    <div>
                                                                        <div class="mb-2 cool-grey danger_status">0
                                                                        </div>
                                                                        <div class="danger_status">متأخر</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row isuue_item">
                                                    <div class="col">
                                                        <span class="flex_items">
                                                            <p class="warning_status">بوليصة التأمين</p>
                                                            <p class="bottom_text_line">ينتهي في <span
                                                                    class="warning_status">12/2/2020</span></p>
                                                        </span>
                                                        <span class="flex_items">
                                                            <p class="safe_status">الترخيص</p>
                                                            <p class="bottom_text_line">ينتهي في <span
                                                                    class="safe_status">12/2/2020</span></p>
                                                        </span>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col ">
                                                <div class="row ">
                                                    <div class=" custom_col">
                                                        <p class="small_title">جهات إتصال يصل إليها إشعارات السيارة</p>
                                                    </div>
                                                    <div class=" left_btn_wrapper">
                                                        <button class="btn dark_btn tiny_padding" width="100%">تعديل
                                                            جهات الإتصال</button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <p>مشرف 1, سائق1, سائق2, مشرف صيانة, محاسب1</p>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col white-bg nonChart_wrapper">
                                        <div class="row boxes_wrapper">
                                            <div class="col ">
                                                <div class="row ">
                                                    <div class=" col">
                                                        <p class="small_title">تتبع حركة السيارة</p>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col map_image_wrapper">
                                                        <div class="" data-toggle="modal" data-target="#gps_modal">
                                                            <img src="images/map_image.png" width="100%" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <p>
                                                            السرعة: 90 كم/الساعة
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
-->
                        <div class="row">
                            <div class="col white-bg car_details">
                                <div class="row ">
                                    <div class="col">
                                        <p class="small_title">
                                            <?php echo $lang['C_D_DETAILS'];?>
                                            
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_CODE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_code'];?> </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_PLATE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_plate_number'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['SYS_CAR_STATUS'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo get_data("car_status","car_status_name","car_status_sn",$_car['cars_car_status']) ;?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_SUPERVISOR'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo get_data("users","users_name","users_sn",$_car['cars_supervisor_id']);?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_PROJECT'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo get_data("projects","projects_name","projects_sn",$_car['cars_project_id'])?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_KILO_NUM'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_kilometer'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_FACTORY'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_factory'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_MODEL'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_model'];?></p>
                                        </div>
                                    </div>

                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_YEAR'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_year'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_CHASSIS'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_chassis'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_INGINE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_engine'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_CONTROLLER'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_controller'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_LONG'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_long'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_WIDTH'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_width'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_HEIGHT'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_height'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['C_D_HIGHT_GROUND'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_height_ground'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_WEIGHT'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_weight'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['DRIVER_MAX_WEIGHT'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_max_weight'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['SYS_CAR_OWNER'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo get_data("car_owner","car_owner_name","car_owner_sn",$_car['cars_owner_type_id'])?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_NUM'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_peoples'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['SYS_TRANSFER'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo get_data("transfer_type","transfer_type_name","transfer_type_sn",$_car['cars_car_type'])?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['CAR_PRICE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_price'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['CAR_YEAR_DAMAGE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_year_damage'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['CAR_DAMAGE_PRICE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_damage_price'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['CAR_ANNUAL_INTEREST'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_annual_interest'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['CAR_GPS'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_gps_fees'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['CAR_MAINTENANCE'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_maintenance_budget'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['C_D_NUM_1'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_number_first'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['C_D_SIZE_1'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo get_data("wheel_size","wheel_size_name","wheel_size_sn",$_car['cars_tire_type_first'])?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"><?php echo $lang['C_D_NUM_1'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_number_first'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_PHOTO'];?></p>
                                        <div class="value_box image_box">
                                            <img src="<?php echo $path.$_car['cars_photo'];?>" height="100%" class="value" width="100%" alt="">

                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="row">
                                            <div class="col car_details_item">
                                                <p class="label"> <?php echo $lang['C_D_SIZE_2'];?></p>
                                                <div class="value_box">
                                                    <p class="value"><?php echo get_data("wheel_size","wheel_size_name","wheel_size_sn",$_car['cars_tire_type_second'])?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col car_details_item">
                                                <p class="label"> <?php echo $lang['SYS_FUEL_TYPE'];?></p>
                                                <div class="value_box">
                                                    <p class="value"><?php echo get_data("fuel_type","fuel_type_name","fuel_type_sn",$_car['cars_fuel_type'])?></p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col car_details_item">
                                                <p class="label"> <?php echo $lang['CAR_OIL_CAPACITY'];?></p>
                                                <div class="value_box">
                                                    <p class="value"><?php echo $_car['cars_oil_capacity'];?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <div class="row">
                                            <div class="col car_details_item">
                                                <p class="label"> <?php echo $lang['C_D_NUM_2'];?></p>
                                                <div class="value_box">
                                                    <p class="value"><?php echo $_car['cars_number_second'];?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col car_details_item">
                                                <p class="label"> <?php echo $lang['SYS_DEPATMENT'];?></p>
                                                <div class="value_box">
                                                    <p class="value"><?php echo get_data("departments","departments_name","departments_sn",$_car['cars_department_id'])?></p>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col car_details_item">
                                                <p class="label"> <?php echo $lang['CAR_TANK_CAPACITY'];?></p>
                                                <div class="value_box">
                                                    <p class="value"><?php echo $_car['cars_tank_capacity'];?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['CAR_CHANGE_OIL'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_oil_change'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_CHANGE_1'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_change_first'];?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 car_details_item">
                                        <p class="label"> <?php echo $lang['C_D_CHANGE_2'];?></p>
                                        <div class="value_box">
                                            <p class="value"><?php echo $_car['cars_change_second'];?></p>
                                        </div>
                                    </div>
                                    <?php foreach($_car['cars_docs'] as $k => $v){
                                            echo'
                                                <div class="row col-md-12">
                                                    <div class="row ">
                                                        <div class="col">
                                                            <p class="small_title">
                                                                '.$v['car_docments_name'].'
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 car_details_item">
                                                        <p class="label"> '.$lang['START_DATE'].'</p>
                                                        <div class="value_box">
                                                            <p class="value">'._date_format($v['car_docments_date_start']).'</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 car_details_item">
                                                        <p class="label">'.$lang['END_DATE'].'</p>
                                                        <div class="value_box">
                                                            <p class="value">'._date_format($v['car_docments_date_end']).'</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 car_details_item">
                                                        <p class="label">'.$lang['VALUE'].'</p>
                                                        <div class="value_box">
                                                            <p class="value">'.$v['car_docments_value'].'</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 car_details_item">
                                                         <img src="'.$path.$v['car_docments_photo'].'" width="50%">
                                                    </div>
                                            </div>';
    
                                        }?>
                                    
                                    
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
<!-- Modal -->
    <div class="modal fade" id="km_log" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content modal_grey_bg">

                <div class="modal-body white-bg chart_wrapper">
                    <div class="chart_header">
                        <h6 class="bold">كم شهري</h6>
                        <div class="date_range">
                            <p>في الفترة من</p>
                            <span class="date_input">
                                <input id="datepicker9" width="100%"
                                    onchange="update_barChart_startdate('kmlog_chart',this)" />
                            </span>
                            <p>الي</p>
                            <span class="date_input">
                                <input id="datepicker10" width="100%"
                                    onchange="update_barChart_enddate('kmlog_chart', this)" />
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
                                    onchange="update_barChart_view('kmlog_chart', this)"   >
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
                                <input id="datepicker11" width="100%"
                                    onchange="update_barChart_startdate('kmCostlog_chart',this)" />
                            </span>
                            <p>الي</p>
                            <span class="date_input">
                                <input id="datepicker12" width="100%"
                                    onchange="update_barChart_enddate('kmCostlog_chart', this)" />
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
                                    onchange="update_barChart_view('kmCostlog_chart', this)"   >
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
                                <input id="datepicker13" width="100%"
                                    onchange="update_barChart_startdate('fuellog_chart',this)" />
                            </span>
                            <p>الي</p>
                            <span class="date_input">
                                <input id="datepicker14" width="100%"
                                    onchange="update_barChart_enddate('fuellog_chart', this)" />
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
                                    onchange="update_barChart_view('fuellog_chart', this)"   >
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

    <!-- GPS MODAL -->
    <div class="modal fade" id="gps_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <i class="fa fa-times-circle" data-dismiss="modal"></i>
                </div>
                <div class="modal-body">
                    <p class="small_title">تتبع حركة السيارة</p>
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d101839.35258916968!2d31.188423265456162!3d30.059469890204635!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14583fa60b21beeb%3A0x79dfb296e8423bba!2sCairo%2C%20Cairo%20Governorate!5e0!3m2!1sen!2seg!4v1582653291265!5m2!1sen!2seg" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <p>السرعة: 90 كم/الساعة</p>
                </div>
            </div>
        </div>
    </div>
<?php include './assets/layout/footer.php';?>

<script src="./assets/js/car-dashboard-charts.js">
