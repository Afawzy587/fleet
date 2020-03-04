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
	$users = new systemusers();

    include("./inc/Classes/system-cars.php");
	$cars = new systemcars();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else
    {
        if($group['cars_order'] == 0){
            header("Location:./permission.php");
            exit;
        }else
        {
            $car             = intval($_GET['c']);
//            $check           = intval($_GET['k']);
            $check           = 1;
            $_projects       = $projects->getsiteprojects();
            $_users          = $users->getselectusers();

            if ($_POST)
            {

                $_order['car_orders_car_id']                   =       intval($_POST["car"]);;
                $_order['car_orders_supervisor_id']            =       intval($_POST["supervisor"]);
                $_order['car_orders_driver_id']                =       intval($_POST["driver"]);
                $_order['car_orders_project_id']               =       intval($_POST["project"]);
                $_order['car_orders_road_id']                  =       intval($_POST["road"]);
                $_order['car_orders_delivery_by']              =       intval($_POST["delivery"]);
                $_order['car_orders_delivery_kilos']           =       sanitize($_POST["delivery_kilos"]);
                $_order['car_orders_delivery_date']            =       format_data_base(sanitize($_POST["delivery_date"]));
                $_order['car_orders_delivery_time']            =       sanitize($_POST["delivery_time"]);
                $_order['car_orders_expect_kilos']             =       sanitize($_POST["expect_kilos"]);
                $_order['car_orders_expect_date']              =       format_data_base(sanitize($_POST["expect_date"]));
                $_order['car_orders_expect_time']              =       sanitize($_POST["expect_time"]);
                $_order['car_orders_check_id']                 =       intval($_POST["check_id"]);

                $add = $cars->add_car_order($_order);
                if ($add == 1)
                {
                    header("Location:./cars.php");
                    exit;
                }
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"car_order",
                            "mode" 		        => 	"add",
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
            }
        }
            
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>

<main class="">
       <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"><?php echo $lang['CARS'];?></h1>
                <h4 class="sub_title"><strong> &gt; </strong> <?php echo $lang['ADD_EXPENSES'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <p class="small_title subtitle"><?php echo $lang['ORDER_DETAILS'];?></p>
            <h5 class=" subtitle darkish-green"> <?php echo $lang['DRIVER_DELIVERD'];?> </h5>
            <div class="container page_body">
                <form action="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
                    <div class="row white-bg assign_to_driver">
                        <div class="col">
                            <div class="row">
                                <div class="message">
                                    <span class="alert_side"></span>
                                    <p class="subtitle">
                                        <i class="fa fa-exclamation-circle"></i>
                                         <?php echo $lang['COMPLETE_P'];?><a href=""> <?php echo ' '.$lang['HER'];?> </a></p>
                                        <input type="text" class="form-control" name="check_id" value="<?php echo $check;?>"  hidden>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR'];?></label>
                                        <?php
                                            if($car != 0)
                                            {
                                                echo'<input type="text" class="form-control" value="'.get_data('cars','cars_code','cars_sn',$car).'" readonly>
                                                    <input type="text" class="form-control"  name="car" value="'.$car.'" hidden>';
                                            }else
                                            {
                                                echo'<select data-live-search="true" class="form-control selectpicker custom-select" title="'.$lang['CHOOSE'].$lang['CAR'].'" name="car" required>';
                                                    foreach($_cars as $k => $c)
                                                    {
                                                        echo '<option value="'.$c['cars_sn'].'">'.$c['cars_code'].'</option>';
                                                    }
                                                
                                                echo'</select>';
                                            }
                                        ?>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> <?php echo $lang['CAR_SUPERVISOR'];?></label>
                                        <select data-live-search="true" class="form-control selectpicker custom-select" title="<?php echo $lang['CHOOSE'].$lang['CAR_SUPERVISOR'];?>" name="supervisor" required>
                                            <?php
                                                foreach($_users as $k => $s)
                                                {
                                                    echo '<option value="'.$s['users_sn'].'">'.$s['users_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['DRIVER'];?></label>
                                        <select data-live-search="true" class="form-control selectpicker custom-select" title="<?php echo $lang['CHOOSE'].$lang['DRIVER'];?>" name="driver" required>
                                            <?php
                                                foreach($_users as $k => $s)
                                                {
                                                    echo '<option value="'.$s['users_sn'].'">'.$s['users_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['PROJECT'];?></label>
                                        <select data-live-search="true" class="project form-control selectpicker custom-select" title="<?php echo $lang['CHOOSE'].$lang['PROJECT'];?>" name="project" required>
                                            <?php
                                                foreach($_projects as $k => $p)
                                                {
                                                    echo '<option value="'.$p['projects_sn'].'">'.$p['projects_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div id="route" class="form-group">
                                        <label><?php echo $lang['ROUTE'];?></label>
                                        <select name="road" id="route" class="md-select custom-select" required>
                                          <option disabled selected value><?php echo $lang['PROJECT_FIRST'];?> </option>
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['DELEVERED_BY'];?></label>
                                        <select data-live-search="true" class="form-control selectpicker custom-select"  title="<?php echo $lang['CHOOSE_RESPONCE'];?>" name="delivery" required>
                                            <?php
                                                foreach($_users as $k => $s)
                                                {
                                                    echo '<option value="'.$s['users_sn'].'">'.$s['users_name'].'</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['KILO_IN_DELEVER'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="delivery_kilos" required>
                                            <div class="invalid-feedback">
                                                <?php echo $lang['INSERT_KILO_IN_DELEVER'];?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['DATE_DELEVER'];?></label>
                                            <input id="datepicker1" width="100%" name="delivery_date" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['TIME_DELEVER'];?></label>
                                            <input id="timepicker1" width="100%" name="delivery_time" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['KILO_IN_BACK'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="expect_kilos" required>
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['INSERT_KILO_IN_DELEVER'];?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> <?php echo $lang['DATE_BACK'];?></label>
                                            <input id="datepicker2" width="100%" name="expect_date" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['TIME_BACK'];?></label>
                                            <input id="timepicker2" width="100%" name="expect_time" required />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 bottom-actions">
                        <div class="col">
                            <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit" <?php if($check == 0){ echo 'disabled';}?>><?php echo $lang['SAVE'];?></button>
                            <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./cars.php"><?php echo $lang['CANCEL'];?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>