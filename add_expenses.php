<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-expenses.php");
	$exp = new systemexpenses();

	include("./inc/Classes/system-suppliers.php");
	$suppliers = new systemsuppliers();

	include("./inc/Classes/system-users.php");
	$users = new systemusers();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['expenses_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
        
            	$car             = intval($_GET['c']);
				if($car != 0)
				{
					$expenses        = $exp->getsiteexpenses();
					$suppliers       = $suppliers->getsitesuppliers();
					$users           = $users->getselectusers();
					
					if ($_POST)
					{
						$_expenses['car_expenses_car_id']                 =       $car;
						$_expenses['car_expenses_expense_id']             =       intval($_POST["expense"]);
						$_expenses['car_expenses_supply_id']              =       intval($_POST["supplier"]);
						$_expenses['car_expenses_date']                   =       format_data_base(sanitize($_POST["date"]));
						$_expenses['car_expenses_by']                     =       intval($_POST["by"]);

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
								$_expenses['car_expenses_doc']  = $upfile['newname'];

							}
						}
						$add = $exp->add_car_expenses($_expenses);
//						if ($add == 1)
//						{
//
//						}
						$logs->addLog(NULL,
								array(
									"type" 		        => 	"admin",
									"module" 	        => 	"add_expenses",
									"mode" 		        => 	"add",
									"id" 	        	=>	$_SESSION['id'],
								),"admin",$_SESSION['id'],1
							);
					}
				}else{
					header("Location:./error.php");
					exit;
				}
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
<main class="">
       <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2">  <?php echo $lang['CARS'];?></h1>
                <h4 class="sub_title"><strong> &gt; </strong> <?php echo $lang['ADD_EXPENSES'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <p class="small_title"><?php echo $lang['ADD_EX_TITLE']?><small>-<?php echo $lang['ADD_EX_TITLE_EXT'];?></small></p>
            <div class="container page_body">
                <form  class=" needs-validation" action="./add_expenses.php?c=<?php echo $car;?>" method="post" enctype="multipart/form-data" novalidate>
                    <div class="row white-bg form2">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['CAR'];?></label>
                                        <input type="text" class="form-control" value="<?php echo get_data('cars','cars_code','cars_sn',$car);?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> <?php echo $lang['EXPENSES_TYPE'];?></label>
                                        <select name="expense" id="" class="md-select custom-select" required>
                                          <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                           <?php foreach($expenses as $k => $v){
													echo '<option value="'.$v['expenses_sn'].'">'.$v['expenses_name'].'</option>';
													}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                             <a class="dark_bg btn small_btn" href="./expenses.php"><?php echo $lang['ADD_EXPENSES_TYPE'] ;?></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> <?php echo $lang['DATE'] ;?></label>
                                        <input id="datepicker6" width="100%" name="date" required/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> <?php echo $lang['SUPPLIER'] ;?></label>
                                        <select name="supplier" id="" class="md-select custom-select" required>
                                          <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                           <?php foreach($suppliers as $k => $s)
											{
                                            	echo '<option value="'.$s['suppliers_sn'].'">'.$s['suppliers_name'].'</option>';
											}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <a class="dark_bg btn small_btn" href="./add_supplier.php?d=add_expenses&c=<?php echo $car;?>">إضافة مورد </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label><?php echo $lang['BY'];?></label>
                                        <select name="by"  class="md-select custom-select" required>
                                           <option disabled selected value><?php echo $lang['CHOOSE'];?> </option>
                                           <?php foreach($users as $k => $s){
													echo '<option value="'.$s['users_sn'].'">'.$s['users_name'].'</option>';
													}?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                   
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile02" name="photo"
                                            aria-describedby="inputGroupFileAddon01" required
                                            onchange="attachmentvalidation(this)">
                                        <label class="custom-file-label" for="inputGroupFile02"><?php echo $lang['ADD_DOC'];?> </label>
                                    </div>
                                    <div class="invalid-feedback required_attachment">
                                        <?php echo $lang['INSERT_ADD_DOC'];?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 bottom-actions">
                        <div class="col">
                            <button class="btn btn-light _btn ml-3" type="submit">   <?php echo $lang['SAVE_ADD_OTHER'];?></button> 
                            <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"> <?php echo $lang['SAVE'];?></button>
                            <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./cars.php"><?php echo $lang['CANCEL'];?></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
    
<?php include './assets/layout/footer.php';?>