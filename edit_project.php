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

	include("./inc/Classes/system-users.php");
	$user = new systemusers();

    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
	
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['projects_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $transfer_type = $informations->getdatatable("transfer_type");                                         // transfer_type
				$users         = $user->getsiteusers();   
                if($_POST)
                {

                    $_car['projects_code']                     =       sanitize($_POST["code"]);
                    $_car['projects_car_type']                 =       intval($_POST["car_type"]);
                    
                    
              
//					$add = $projects->addNewprojects($_car);
                    if($add == 1)
                    {
                        header("Location:./suppliers.php");
                        exit;
                    }
                    

                }
            }
        include './assets/layout/header.php';
        include './assets/layout/navbar.php';
    }
?>
    <main class="">
        <div
            class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"> <?php  echo $lang['PROJECTS'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong><?php  echo $lang['ADD_PROJECT'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <div class="row mt-2">
                <div class="col mr-5 ">
                    <form action="" id="addProjectForm">
                        <div class="row white-bg">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['PROJECT_NAME'];?></label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="project_name">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_SUPER'];?></label>
                                    <div class="col-xs-5">
                                        <select data-live-search="true" class="form-control selectpicker custom-select" title="<?php  echo $lang['CHOOSE'];?>" name="supervisor" required>
                                            <?php
                                                foreach($users as $k => $v)
                                                {
                                                    echo '<option value="'.$v['users_name'].'" >'.$v['users_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_CLIENT_REP'];?></label>
                                    <div class="col-xs-5">
                                        <input type="text" class="form-control" name="representer">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['CONTRACT_DATE'];?></label>
                                    <div class="col-xs-5">
                                        <input id="datepicker1" width="100%" name="start_date" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_END_IN'];?></label>
                                    <div class="col-xs-5">
                                        <input id="datepicker2" width="100%" name="end_date" />

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="col-xs-3"><?php  echo $lang['P_CLIENT_PHONE'];?></label>
                                    <div class="col-xs-5">
                                        <input type="text" width="100%" name="phone" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row white-bg mt-2">
                            <div class="col">
                                <div class="row">
                                    <div class="col" id="truck_types">
                                        <div class="row" id="truck_type_item">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-xs-3"><?php  echo $lang['P_CAR_NUM'];?></label>
                                                    <div class="col-xs-5">
                                                        <input class="form-control small_input" name="car_number[]" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-xs-3"><?php  echo $lang['SYS_TRANSFER'];?></label>
                                                    <div class="col-xs-5">
                                                        <select class="form-control md-select" title="<?php  echo $lang['CHOOSE'];?>" name="truck_type">
                                                            <?php
                                                                echo '<option>'.$lang['CHOOSE'].'</option>';
                                                                foreach($transfer_type as $k => $t)
                                                                {
                                                                    echo '<option value="'.$t['transfer_type_name'].'" >'.$t['transfer_type_name'].'</option>';
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="col-xs-3"><?php  echo $lang['PRO_MAX_KILO'];?></label>
                                                    <div class="col-xs-5">
                                                        <input type="text" name="max_monthly_km" class="form-control small_input" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  add_type_row">
                                    <div class="add_item pale-teal" id="add_truck_type">
                                        <i class="fas fa-plus-circle darkish-green"></i>
                                        <?php  echo $lang['PRO_ADD_TYPE_TRAN'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-5">
                                <h2 class="small_title"><?php  echo $lang['PRO_CARS_DETAILS'];?></h2>
                            </div>
                        </div>
                        <div class="row white-bg">
                            <div class="col">
                                <table class="table eq_table" id="">
                                    <thead>
                                        <tr>
                                            <th>نوع النقل</th>
                                            <th class="wider_col">السيارة</th>
                                            <th>الملكية</th>
                                            <th>المالك</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="project_cars">
                                        <tr id="project_car">
                                            <td>
                                                ركاب
                                            </td>
                                            <td>
                                                <p class="dodger-blue">ق أ س 104 - 5563</p>
                                            </td>
                                            <td>
                                                تمليك
                                            </td>
                                            <td></td>
                                            <td>
                                                <i class="fas fa-trash rose ml-2" data-toggle="modal"
                                                    data-target="#Deleteconfirmation"></i>
                                            </td>
                                        </tr>
                                        <tr id="project_car">
                                            <td>
                                                ركاب
                                            </td>
                                            <td>
                                                <p class="dodger-blue">ق أ س 104 - 5563</p>
                                            </td>
                                            <td>
                                                تمليك
                                            </td>
                                            <td>مالك 1</td>
                                            <td>
                                                <i class="fas fa-trash rose ml-2" data-toggle="modal"
                                                    data-target="#Deleteconfirmation"></i>
                                            </td>
                                        </tr>
                                    <tbody>
                                </table>
                                <div class="add_item pale-teal" data-toggle="modal" data-target="#addCar">
                                    <i class="fas fa-plus-circle darkish-green"></i>
                                    أضف سيارة للمشروع
                                </div>
                            </div>
                        </div>



                        <div class="row mt-5">
                            <div class="col-md-5">
                                <h2 class="small_title">تفاصيل خطوط السير</h2>
                            </div>

                        </div>

                        <div class="row white-bg">
                            <div class="col">
                                <table class="table eq_table" id="">


                                    <thead>
                                        <tr>
                                            <th>كود السيارة</th>
                                            <th>من</th>
                                            <th>الي</th>
                                            <th>المسافة بالكيلومتر</th>
                                            <th>دورة كاملة</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="routes">
                                        <tr id="route">
                                            <td>
                                                0015
                                            </td>
                                            <td>
                                                مكان 1
                                            </td>
                                            <td>
                                                مكان 2
                                            </td>
                                            <td>25</td>
                                            <td>

                                                <i class=" fa fa-square dodger-blue"></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-trash rose ml-2" data-toggle="modal"
                                                    data-target="#Deleteconfirmation"></i>
                                            </td>
                                        </tr>
                                        <tr id="route">
                                            <td>
                                                0015
                                            </td>
                                            <td>
                                                مكان 1
                                            </td>
                                            <td>
                                                مكان 2
                                            </td>
                                            <td>25</td>
                                            <td class="route_type">
                                                <i class=" fa fa-square light-grey"></i>
                                            </td>
                                            <td>
                                                <i class="fas fa-trash rose ml-2" data-toggle="modal"
                                                    data-target="#Deleteconfirmation"></i>
                                            </td>
                                        </tr>
                                    <tbody>
                                </table>
                                <div class="add_item pale-teal" id="add_task_line" data-toggle="modal"
                                    data-target="#addroute">
                                    <i class="fas fa-plus-circle darkish-green"></i>
                                    أضف خط سير
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3 bottom-actions">
                            <div class="col">
                                <button class="btn _btn btn-light darkish-green ml-3">حفظ وإضافة آخري</button>
                                <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit">حفظ</button>
                                <button class="btn _btn btn-danger rose-bg ml-3">إلغاء</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
<!-- Modal  -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="AddDocModal" aria-labelledby="AddDocModal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered ">
              <div class="modal-content grey-bg">
                  <form class="needs-validation addDocForm" id="add_doc_form" >
                      <div class="modal-body">
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="">اسم الوثيقة</label>
                                      <div>
                                          <input type="text" class="form-control" name="doc_name" required>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-3">
                                  <div class="form-group">
                                      <label for="">اسم تاريخ1</label>
                                      <div>
                                          <input type="text" class="form-control" name="date_input_name" required>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-md-3">
                                <div class="form-group">
                                    <label for=""> اسم تاريخ2</label>
                                    <div>
                                        <input type="text" class="form-control" name="date2_input_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">اسم زر الصورة</label>
                                    <div>
                                        <input type="text" class="form-control" name="imageBtn_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">اسم القيمة</label>
                                    <div>
                                        <input type="text" class="form-control" name="value_input_name" required>
                                    </div>
                                </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-success _btn darkish-green-bg ml-3" id="AddDocBtn" >حفظ</a>
                            <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal">إلغاء</a>
                        </div>
                </form>
              </div>
            </div>
          </div>

<?php include './assets/layout/footer.php';?>
<script src="./assets/js/formValidation.js"></script>
<script src="./assets/js/framework/bootstrap.js"></script>
<script src="./assets/js/add_project.js">



</script>
