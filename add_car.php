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
	include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
	include("./inc/Classes/system-users.php");
	$user = new systemusers();
	include("./inc/Classes/system-projects.php");
	$project = new systemprojects();
	
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['cars_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
				$departments   = $informations->getdatatable("departments");                                           // departments
                $car_status    = $informations->getdatatable("car_status");                                            // car_status
                $car_owner     = $informations->getdatatable("car_owner");                                             // car_owner
                $transfer_type = $informations->getdatatable("transfer_type");                                         // transfer_type
                $fuel_type     = $informations->getdatatable("fuel_type");                                             // fuel_type
                $wheel_size    = $informations->getdatatable("wheel_size");                                            // wheel_size
                $supply_type   = $informations->getdatatable("supply_type");                                          // supply_type
				$users         = $user->getsiteusers();   
				$projects      = $project->getsiteprojects();   
                if($_POST)
                {

                    $_car['cars_code']                     =       sanitize($_POST["code"]);
                    $_car['cars_plate_number']             =       sanitize($_POST["plate"]);
                    $_car['cars_chassis']                  =       sanitize($_POST["chesssis"]);
                    $_car['cars_engine']                   =       sanitize($_POST["engine"]);
                    $_car['cars_factory']                  =       sanitize($_POST["factory"]);
                    $_car['cars_model']                    =       sanitize($_POST["model"]);
                    $_car['cars_year']                     =       sanitize($_POST["year"]);
                    $_car['cars_kilometer']                =       sanitize($_POST["kilometer"]);
                    $_car['cars_car_type']                 =       intval($_POST["car_type"]);
                    $_car['cars_owner_type_id']            =       intval($_POST["owner_type"]);
                    $_car['cars_supervisor_id']            =       intval($_POST["supervisor"]);
                    $_car['cars_project_id']               =       intval($_POST["project"]);
                    $_car['cars_car_status']               =       intval($_POST["car_status"]);
                    $_car['cars_kilo_litre']               =       sanitize($_POST["kilo_litre"]);
                    $_car['cars_department_id']            =       intval($_POST["department"]);
                    $_car['cars_long']                     =       sanitize($_POST["long"]);
                    $_car['cars_height']                   =       sanitize($_POST["height"]);
                    $_car['cars_width']                    =       sanitize($_POST["width"]);
                    $_car['cars_peoples']                  =       sanitize($_POST["peoples"]);
                    $_car['cars_weight']                   =       sanitize($_POST["weight"]);
                    $_car['cars_max_weight']               =       sanitize($_POST["max_weight"]);
                    $_car['cars_controller']               =       sanitize($_POST["controller"]);
                    $_car['cars_fuel_type']                =       intval($_POST["fuel_type"]);
                    $_car['cars_tank_capacity']            =       sanitize($_POST["tank_capacity"]);
                    $_car['cars_oil_capacity']             =       sanitize($_POST["cars_oil_capacity"]);
                    $_car['cars_oil_change']               =       sanitize($_POST["oil_change"]);
                    $_car['cars_tire_type_first']          =       intval($_POST["tire_type_first"]);
                    $_car['cars_tire_type_second']         =       intval($_POST["tire_type_second"]);
                    $_car['cars_number_first']             =       intval($_POST["number_first"]);
                    $_car['cars_number_second']            =       intval($_POST["number_second"]);
                    $_car['cars_change_first']             =       sanitize($_POST["change_first"]);
                    $_car['cars_change_second']            =       sanitize($_POST["change_second"]);
                    $_car['cars_price']                    =       sanitize($_POST["price"]);
                    $_car['cars_year_damage']              =       intval($_POST["year_damage"]);
                    $_car['cars_damage_price']             =       sanitize($_POST["damage_price"]);
                    $_car['cars_maintenance_budget']       =       sanitize($_POST["maintenance_budget"]);
                    $_car['cars_annual_interest']          =       sanitize($_POST["annual_interest"]);
                    $_car['cars_gps_fees']                 =       sanitize($_POST["gps_fees"]);
                    $_car['cars_maintenance_expectation']  =       sanitize($_POST["maintenance_expectation"]);
                    $_car['cars_expenses']                 =       sanitize($_POST["expenses"]);
                    $_car['max_kilo']                      =       sanitize($_POST["max_kilo"]);
                    $_car['cars_driver_salary']            =       sanitize($_POST["driver_salary"]);
                    $_car['cars_kilo_litre']               =       sanitize($_POST["kilo_litre"]);
                    $start_date=[];
                    $end_date=[];
                    foreach($_POST["start_date"] as $k => $v){
                        
                        $start_date[$k] = format_data_base($v);
                        $end_date[$k] = format_data_base($_POST["end_date"][$k]);
                    }
                    $_car['car_docments_name']             =       $_POST["name"];
                    $_car['car_docments_date_start']       =       $start_date;
                    $_car['car_docments_date_end']         =       $end_date;
                    $_car['car_docments_value']            =       $_POST["value"];
                    
                    
                    if( $_FILES && ( $_FILES['photo']['name'] != "") && ( $_FILES['photo']['tmp_name'] != "" ) )
                    {
                        include_once("./inc/Classes/upload.class.php");
                        $allow_ext = array("jpg","jpeg","gif","png");
                        $upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
                        $files['name'] 	= addslashes($_FILES["photo"]["name"]);
                        $files['type'] 	= $_FILES["photo"]['type'];
                        $files['size'] 	= $_FILES["photo"]['size']/1024;
                        $files['tmp'] 	= $_FILES["photo"]['tmp_name'];
                        $files['ext']		= $upload->GetExt($_FILES["photo"]["name"]);
                        $upfile	= $upload->Upload_File($files);
                        if($upfile)
                        {
                            $_car['cars_photo']  = $upfile['newname'];
                            
                        }
                    }
                    $_file=[];
                    foreach($_FILES['doc_file']['name'] as $key=>$val) 
                    {
                        if( $_FILES && ( $_FILES['doc_file']['name'][$key] != "") && ( $_FILES['doc_file']['tmp_name'][$key] != "" ) )
                        {
                            include_once("./inc/Classes/upload.class.php");
                            $allow_ext = array("jpg","jpeg","gif","png");
                            $upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
                            $files['name'] 	= addslashes($_FILES["doc_file"]["name"][$key]);
                            $files['type'] 	= $_FILES["doc_file"]['type'][$key];
                            $files['size'] 	= $_FILES["doc_file"]['size'][$key]/1024;
                            $files['tmp'] 	= $_FILES["doc_file"]['tmp_name'][$key];
                            $files['ext']		= $upload->GetExt($_FILES["doc_file"]["name"][$key]);
                            $upfile	= $upload->Upload_File($files);
                            if($upfile)
                            {
                                $_file[$key]  = $upfile['newname'];

                            }
                        }
                    }
                   $_car['cars_docs_file'] = $_file ;
					$add = $cars->addNewcars($_car);
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
                <h1 class="h2"> <?php  echo $lang['CARS'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong><?php  echo $lang['ADD_CAR'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li class="active">
                            <a href="#generalDetails" role="tab" data-toggle="tab"> <?php  echo $lang['CAR_DETAILS'];?></a>
                        </li>
                        <li>
                            <a href="#TecSpecs" role="tab" data-toggle="tab"> <?php  echo $lang['CAR_OPTION'];?>
                            </a>
                        </li>
                        <li>
                            <a href="#Documents" role="tab" data-toggle="tab"> <?php  echo $lang['CAR_DOCS'];?></a>
                        </li>
                        <li>
                            <a href="#FluidsTires" role="tab" data-toggle="tab"> <?php  echo $lang['CAR_FUEL'];?></a>
                        </li>
                        <li>
                            <a href="#CostPerKm" role="tab" data-toggle="tab"> <?php  echo $lang['CAR_KILO_COST'];?></a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="container page_body">
                <form method="post" action="./add_car.php"  class="fleet_general_form needs-validation" id="addCar_form" enctype="multipart/form-data" novalidate>
                    <div class="tab-content">
                        <div class="tab-pane active" id="generalDetails">
                            <div class="row white-bg mt-5">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label> <?php  echo $lang['CAR_CODE'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="code" required maxlength="50" pattern="^[0-9]*$">
                                           <div class="invalid-feedback"><?php  echo $lang['INSERT_CAR_CODE'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> <?php  echo $lang['CAR_FACTORY'];?></label>
                                        <div>
                                            <input type="text" class="form-control"  required maxlength="25" name="factory">
                                            <div class="invalid-feedback"><?php  echo $lang['INSERT_CAR_FACTORY'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> <?php  echo $lang['CAR_TRANSPORT'];?></label>
                                        <div>
                                            <select name="car_type"  class="md-select custom-select" required>
                                                <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                           		<?php foreach($transfer_type as $k => $t){
													echo '<option value="'.$t['transfer_type_sn'].'">'.$t['transfer_type_name'].'</option>';
													}?>
                                       	   </select>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php  echo $lang['CAR_STATUS'];?></label>
                                        <div>
                                            <select name="car_status"  class="md-select custom-select" required>
                                                <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                           		<?php foreach($car_status as $k => $S){
													echo '<option value="'.$S['car_status_sn'].'">'.$S['car_status_name'].'</option>';
													}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_PLATE'];?></label>
                                        <div>
                                            <input type="text" name="plate" class="form-control" name="car_number" required maxlength="127">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_PLATE'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_MODEL'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="model" required maxlength="25">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_MODEL'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_OWNER'];?></label>
                                        <div>
                                            <select name="owner_type"  class="md-select custom-select" required>
                                                 <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                           		<?php foreach($car_owner as $k => $c){
													echo '<option value="'.$c['car_owner_sn'].'">'.$c['car_owner_name'].'</option>';
													}?>
                                            </select>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_CHASSIS'];?></label>
                                        <div>
                                            <input type="text" name="chesssis" class="form-control" required maxlength="25">
                                            <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_CHASSIS'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_YEAR'];?></label>
                                        <div>
                                            <input type="text"  name="year" class="form-control" required maxlength="4" pattern="^[0-9]*$">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_YEAR'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> <?php echo $lang['CAR_SUPERVISOR'];?></label>
                                        <div>
                                            <select name="supervisor" id="" class="md-select custom-select" required>
                                                <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                           		<?php foreach($users as $k => $r){
													echo '<option value="'.$r['users_sn'].'">'.$r['users_name'].'</option>';
													}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_PHOTO'];?></label>
                                        <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input" id="inputGroupFile02"
                                                aria-describedby="inputGroupFileAddon01" required>
                                            <label class="custom-file-label" for="inputGroupFile02"><?php echo $lang['CHOOSE_CAR_PHOTO'];?></label>
                                            <div class="invalid-feedback">
                                             <?php echo $lang['INSERT_CAR_PHOTO'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_INGINE'];?></label>
                                        <div>
                                            <input type="text" name="engine" class="form-control" required maxlength="25">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_INGINE'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_KILO_METER'];?></label>
                                        <div>
                                            <input type="text" name ="kilometer" class="form-control" required maxlength="6" pattern="^[1-9]\d*(\.\d+)?$">
                                            <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_KILO_METER'];?></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label> <?php echo $lang['CAR_PROJECT'];?></label>
                                        <div>
                                            <select name="project"  class="md-select custom-select" required>
                                                <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                           		<?php foreach($projects as $k => $p){
													echo '<option value="'.$p['projects_sn'].'">'.$p['projects_name'].'</option>';
													}?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['SYS_DEPATMENT'];?> </label>
                                        <div>
                                            <select name="department" id="" class="md-select custom-select" required>
                                               <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                                <?php foreach($departments as $k => $d){
													echo '<option value="'.$d['departments_sn'].'">'.$d['departments_name'].'</option>';
													}?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3 bottom-actions">
                                <div class="col">
                                    <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"><?php echo $lang['CAR_NEXT'];?></button>
                                    <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./cars.php"><?php echo $lang['CANCEL'];?></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="TecSpecs">
                            <div class="row white-bg mt-5">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_LONG'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="long" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_LONG'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_WIDTH'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="width" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_WIDTH'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_HEIGHT'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="height" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_HEIGHT'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_PEOPLES'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="peoples" required maxlength="50" pattern="^[0-9]*$">
                                            <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_PEOPLES'];?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_WEIGHT'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="weight" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_WEIGHT'];?></div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR_CONTROLLER'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="controller" required maxlength="50">
                                            <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_CONTROLLER'];?></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row mt-3 bottom-actions">
                                <div class="col">
                                    <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"><?php echo $lang['CAR_NEXT'];?></button>
                                    <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./cars.php"><?php echo $lang['CANCEL'];?></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane documents" id="Documents">
                            <div class="row white-bg mt-5">
                                <div class="col ">
                                    <div class="documents_list">
                                        <div class="row">
                                            <div class="col">
                                                <p class="small_title"><?php echo $lang['DOC_lic'];?></p>
                                                <input type="hidden" name="name[]" value="<?php echo $lang['DOC_lic'];?>">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label><?php echo $lang['DATE'].$lang['DOC_lic'];?></label>
                                                            <input id="datepicker4" width="100%" name="start_date[]" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label><?php echo $lang['END'].$lang['DOC_lic'];?></label>
                                                            <input id="datepicker5" width="100%" name="end_date[]" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="inputGroupFile02" name = "doc_file[]" requiredaria-describedby="inputGroupFileAddon01">
                                                                <label class="custom-file-label" for="inputGroupFile02"><?php echo $lang['UPLOAD_IMG'];?></label>
                                                                <div class="invalid-feedback">  <?php echo $lang['INSERT_UPLOAD_IMG'];?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label> <?php echo $lang['VALUE'];?></label>
                                                            <div>
                                                                <input type="text" class="form-control" required name="value[]" maxlength="6" pattern="^[1-9]\d*(\.\d+)?$">
                                                                <div class="invalid-feedback"><?php echo $lang['INSERT_VALUE'];?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row document_item">
                                            <div class="col">
                                                <p class="small_title document_title"><?php echo $lang['DOC_L'];?></p>
                                                <input type="hidden" name="name[]" value="<?php echo $lang['DOC_L'];?>">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="start_date[]"><?php echo $lang['DATE'].$lang['DOC_LI'];?></label>
                                                            <input id="datepicker6" width="100%" name="start_date[]" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3" >
                                                        <div class="form-group">
                                                            <label for="end_date[]"><?php echo $lang['END'].$lang['DOC_LI'];?></label>
                                                            <input id="datepicker7" width="100%" name="end_date[]" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name = "doc_file[]" id="inputGroupFile02" required aria-describedby="inputGroupFileAddon01">
                                                                <label class="image_upload_btn custom-file-label" for="inputGroupFile02"><?php echo $lang['UPLOAD_IMG'];?></label>
                                                                <div class="invalid-feedback">  <?php echo $lang['INSERT_UPLOAD_IMG'];?></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="value[]"> <?php echo $lang['VALUE'];?></label>
                                                            <div>
                                                                <input type="text" class="form-control" required name="value[]" maxlength="6" pattern="^[1-9]\d*(\.\d+)?$">
                                                                <div class="invalid-feedback"><?php echo $lang['INSERT_VALUE'];?></div>
                                                            </div>
                                                        </div>
                                                    </div>
    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="addDocRow">
                                        <div class="col">
                                            <p class="add_item pale-teal" data-toggle="modal" data-target="#AddDocModal">
                                                <i class="fas fa-plus-circle darkish-green"></i>
                                                <?php echo $lang['ADD_doc'] ;?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 bottom-actions">
                                <div class="col">
                                    <div class="col">
                                    <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"><?php echo $lang['CAR_NEXT'];?></button>
                                    <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./cars.php"><?php echo $lang['CANCEL'];?></a>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="FluidsTires">
                            <div class="row white-bg mt-5 FluidsTires">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['SYS_FUEL_TYPE'];?></label>
                                                    <select name="fuel_type" id="" class="md-select custom-select" required>
                                                        <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                                        <?php foreach($fuel_type as $k => $f){
                                                            echo '<option value="'.$f['fuel_type_sn'].'">'.$f['fuel_type_name'].'</option>';
                                                        }?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_TANK_CAPACITY']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control" name="tank_capacity" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_TANK_CAPACITY']; ?></div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_OIL_CAPACITY']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control" name="oil_capacity" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_OIL_CAPACITY']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_CHANGE_OIL']; ?> </label>
                                                <div>
                                                    <input type="text" class="form-control" name="oil_change" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_CHANGE_OIL']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_SIZE_ONE']; ?></label>
                                                    <select name="tire_type_first" id="" class="md-select custom-select" required>
                                                        <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                                        <?php foreach($wheel_size as $k => $z){
                                                            echo '<option value="'.$z['wheel_size_sn'].'">'.$z['wheel_size_name'].'</option>';
                                                        }?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_NUM_ONE']; ?></label>
                                                <div>
                                                    <input type="text" name="number_first" class="form-control" required maxlength="50" pattern="^[0-9]*$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_NUM_ONE']; ?> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_CHANGE_ONE']; ?></label>
                                                <div>
                                                    <input type="text" name="change_first" class="form-control" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_CHANGE_ONE']; ?> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_SIZE_SECOND']; ?></label>
                                                    <select name="tire_type_second" id="" class="md-select custom-select" required>
                                                        <option disabled selected value><?php echo $lang['CHOOSE'];?></option>
                                                        <?php foreach($wheel_size as $k => $z){
                                                            echo '<option value="'.$z['wheel_size_sn'].'">'.$z['wheel_size_name'].'</option>';
                                                        }?>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_NUM_SECOND']; ?></label>
                                                <div>
                                                    <input type="text" name="number_second" class="form-control" required maxlength="50" pattern="^[0-9]*$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_NUM_SECOND']; ?> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_CHANGE_SECOND']; ?></label>
                                                <div>
                                                    <input type="text" name="change_second" class="form-control" required maxlength="50" pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_CHANGE_SECOND']; ?> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3 bottom-actions">
                                <div class="col">
                                    <button class="btn btn-success _btn darkish-green-bg ml-3"
                                        type="submit"><?php echo $lang['CAR_NEXT']; ?></button>
                                    <button class="btn _btn btn-danger rose-bg ml-3"><?php echo $lang['CANCEL']; ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="CostPerKm">
                            <div class="row mt-3 topleft ">
                                <div class="col-md-3 green_box">
                                    <p class="darkish-green"><?php echo $lang['COST_KILO_N']; ?> = 4.2</p>
                                    <p><?php echo $lang['C_AVERAGE']; ?> = 4.5 </p>
                                </div>
                            </div>
                            <div class="row white-bg mt-2">
                                <div class="col-md-7 inner_col_noPadding costs_inputs_wrapper">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_PRICE']; ?></label>
                                                <div>
                                                    <input type="text" name="price" class="form-control small_input"  required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_PRICE']; ?></div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_YEAR_DAMAGE']; ?></label>
                                                <div>
                                                    <input type="text" name="year_damage" class="form-control smaller_input"  required pattern="^[0-9]*$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_YEAR_DAMAGE']; ?></div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo $lang['CAR_DAMAGE_PRICE']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="damage_price" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_DAMAGE_PRICE']; ?></div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_MAIN_BUDGET']; ?> </label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="maintenance_budget" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback">  <?php echo $lang['INSERT_CAR_MAIN_BUDGET']; ?></div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_ANNUAL_INTEREST']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="annual_interest" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback">  <?php echo $lang['INSERT_ANNUAL_INTEREST']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo $lang['CAR_GPS']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="gps_fees" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_GPS']; ?></div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo $lang['CAR_MAINTENANCE']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="maintenance_expectation" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_MAINTENANCE']; ?></div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_EXPENSES']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="expenses" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"><?php echo $lang['INSERT_CAR_EXPENSES']; ?></div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_LITER_KILO']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="kilo_litre" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_LITER_KILO']; ?></div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $lang['CAR_MAX_KILO']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="max_kilo" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback"> <?php echo $lang['INSERT_CAR_MAX_KILO']; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label> <?php echo $lang['CAR_CAP_SALARY']; ?></label>
                                                <div>
                                                    <input type="text" class="form-control smaller_input" name="driver_salary" required pattern="^[1-9]\d*(\.\d+)?$">
                                                    <div class="invalid-feedback">  <?php echo $lang['INSERT_CAR_CAP_SALARY']; ?> </div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="row type_1">

                                        <div class="col-md-5 type_title">
                                            <h6><?php echo $lang['FIX_COST'];?></h6>
                                            <div>
                                                <p>18.3% </p>
                                                <p>0.78 <?php echo $lang['AC'];?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-7 progress_wrapper">
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p> <?php echo $lang['destruction'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['EGP'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type1" style="width:20%"></div>
                                                </div>
                                            </div>

                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p> <?php echo $lang['benefit'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['EGP'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type1" style="width:20%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p> <?php echo $lang['deposit'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['EGP'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type1" style="width:80%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p> <?php echo $lang['license'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['EGP'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type1" style="width:30%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p><?php echo $lang['GPS'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['EGP'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type1" style="width:50%"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row type_2">

                                        <div class="col-md-5 type_title">
                                            <h6><?php echo $lang['CHANGE_FOR_KM'];?></h6>
                                            <div>
                                                <p>18.3% </p>
                                                <p>0.78 <?php echo $lang['AC'];?></p>
                                            </div>
                                        </div>
                                        <div class="col-md-7 progress_wrapper">
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p><?php echo $lang['ANNUAL'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['AC'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type2" style="width:20%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p><?php echo $lang['WHEEL'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['AC'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type2" style="width:60%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p><?php echo $lang['FUEL'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['AC'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type2" style="width:20%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p><?php echo $lang['DRIVER'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['AC'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type2" style="width:20%"></div>
                                                </div>
                                            </div>
                                            <div class="progress_item">
                                                <div class="progress_text">
                                                    <p><?php echo $lang['Maintenance'];?></p>
                                                    <p>(7.6%) - 0.10 <?php echo $lang['AC'];?></p>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar type2" style="width:15%"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row mt-3 bottom-actions">
                                <div class="col">
                                    <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"><?php echo $lang['SAVE'];?></button>
                                    <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./cars.php"><?php echo $lang['CANCEL'];?></a>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </form>
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
<script src="./assets/js/fleet_add_car_doc.js">



</script>
