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

    include("./inc/Classes/system-users.php");
	$users = new systemusers();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
        $car  = intval($_GET['c']);
        if ($car != 0)
        {
            if($group['check_item_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $_users           = $users->getselectusers();

                if ($_POST)
                {
                    $_damage['car_damage_car_id']                   =       intval($_POST["car_id"]);
                    $_damage['car_damage_by']                       =       intval($_POST["by"]);
                    $_damage['car_damage_date']                     =       format_data_base(sanitize($_POST["date"]));
                    $_damage['car_damage_tank']                     =       intval($_POST["tank"]);
                    $_damage['car_damage_kilos']                    =       sanitize($_POST["kilos"]);
                    $_damage['car_damage_name']                     =       sanitize($_POST["name"]);
                    $_damage['car_damage_text']                     =       sanitize($_POST["text"]);
                    
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
								$_damage['car_damage_photo']  = $upfile['newname'];

							}
						}
                        $add = $car_damage  ->addNewcar_damage($_damage);
						if ($add == 1)
						{
                            if(intval($_POST["add_other"]) == 1)
                            {
                                header("Location:./add_damage.php?c=".$car);
                                exit;
                            }else{
                                header("Location:./car_damage.php?c=".$car);
                                exit;
                            }

						}
                    $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"car_damage",
                            "mode" 		        => 	"add_damage",
                            "total" 		    => 	$car,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
                }
                
                

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
                <h1 class="h2"><?php echo $lang['GR_DAMAGE'];?></h1>
                <h4 class="sub_title"> <strong> &gt; </strong> <?php echo $lang['DAMAGE_ADD'];?></h4>
            </span>

        </div>
        <div class="container page_body">
            <div class="container page_body">

                <form action="" class="add-isuue-form needs-validation" method="post" action="./add_damage.php?c=<?php echo $car;?>" novalidate>
                    <div class="row">
                        <div class="col white-bg">
                            <div class="row ">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR'];?></label>
                                        <div>
                                            <input type="text" class="form-control center" name="form_name" readonly value="<?php echo get_data('cars','cars_code','cars_sn',$car);?>">
                                            <input type="text" class="form-control center" name="car_id"  value="<?php echo $car;?>" hidden>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>بواسطة</label>
                                        <select data-live-search="true" class="form-control selectpicker " name="by" required>
                                            <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                            <?php foreach($_users as $k => $s){
													echo '<option value="'.$s['users_sn'].'">'.$s['users_name'].'</option>';
													}?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['DATE'];?></label>
                                        <input id="datepicker1" width="100%" name="date" required />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['FUEL_CAPACITY'];?></label>
                                        <select data-live-search="true" class="form-control selectpicker custom-select"  name="tank" required>
                                            <option value='0'> <?php echo $lang['EMPTY'];?></option>
                                            <option value='1'> <?php echo $lang['QUATERY'];?></option>
                                            <option value='2'> <?php echo $lang['HALF'];?></option>
                                            <option value='3'> <?php echo $lang['NOT_COP'];?></option>
                                            <option value='4'> <?php echo $lang['F_TANK'];?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> <?php echo $lang['C_D_KILO_NUM'];?></label>
                                        <div>
                                            <input type="text" class="form-control small_input" required pattern="^[1-9]\d*(\.\d+)?$" name="kilos">
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['INSERT_KILO_NUM'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row white-bg mt-2 ">
                        <div class="col">
                            <h5 class=" tangerine"> <?php echo $lang['DAMAGE_DETAILS'];?></h5>
                        </div>
                    </div>
                    <div class="row white-bg mt-2 ">
                        <div class="col-md-4">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile02"  name="photo" aria-describedby="inputGroupFileAddon01" required="" onchange="attachmentvalidation(this)">
                                <label class="custom-file-label" for="inputGroupFile02"> <?php echo $lang['DAMAGE_PHOTO'];?> </label>
                                <div class="invalid-feedback"><?php echo $lang['ADD_DAMAGE_PHOTO'];?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row white-bg mt-2 ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo $lang['DAMAGE'];?></label>
                                <div>
                                    <input type="text" class="form-control" name="name" required maxlength="25">
                                    <div class="invalid-feedback">
                                         <?php echo $lang['INSERT_DAMAGE'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row white-bg mt-2 ">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><?php echo $lang['DAMAGE_DETAILS'];?></label>
                                <div>
                                    <textarea type="text" class="form-control" name="text" required rows="5"></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo $lang['INSERT_DAMAGE_DETAILS'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" name="add_other" required maxlength="25" hidden>
                    <div class="row mt-3 bottom-actions">
                        <div class="col">
                            <button class="add_other btn btn-light _btn ml-3" type="submit">   <?php echo $lang['SAVE_ADD_OTHER'];?></button> 
                            <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"> <?php echo $lang['SAVE'];?></button>
                            <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./car_damage.php?c=<?php echo $car;?>"><?php echo $lang['CANCEL'];?></a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>

