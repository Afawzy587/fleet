<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    include("./inc/Classes/system-users.php");
	$user = new systemusers();

    include("./inc/Classes/system-suppliers.php");
	$suppliers = new systemsuppliers();
    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
			$supply_type   = $informations->getdatatable("supply_type");                                          // supply_type
			$users         = $user->getsiteusers();                                          // supply_type
            if($group['suppliers_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $car = intval($_GET['c']);
                if($_POST)
                {

                    $_suppllier['suppliers_type']                     =       "spare";
                    $_suppllier['suppliers_name']                     =       sanitize($_POST["name"]);
				    $_suppllier['suppliers_supply_id']                =       intval($_POST["supplly_type"]);
                    $_suppllier['suppliers_accountable_id']           =       intval($_POST["response"]);
                    $_suppllier['suppliers_phone']                    =       sanitize($_POST["phone"]);
                    $_suppllier['suppliers_address']                  =       sanitize($_POST["address"]);
                    $_suppllier['suppliers_city']                     =       sanitize($_POST["city"]);
                    $_suppllier['suppliers_contract_start']           =       format_data_base(sanitize($_POST["start_date"]));
                    $_suppllier['suppliers_contract_end']             =       format_data_base(sanitize($_POST["end_date"]));
                    $_suppllier['suppliers_email']                    =       sanitize($_POST["email"]);

                   if($check == 1)
					{ 
                    		$add = $suppliers->addNewsuppliers($_suppllier);
				    }else{
						   $add = $suppliers->addNewsuppliers($_suppllier);
//						   header("Location:./suppliers.php");
				   }

                }
            }
        include './assets/layout/header.php';
        include './assets/layout/navbar.php';
    }
?>
<main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
           <span class="page_titles">
            	<h1 class="h2"><?php echo $lang['CONT_TITLE'];?></h1>
            	<h4 class="sub_title"> <strong> / </strong><?php echo $lang['CONT_SUPLLIERS'];?></h4>
            	<h4 class="sub_title"> <strong> / </strong><?php echo $lang['SU_ADD'];?></h4>
		   </span>
        </div>
        <div class="container page_body">
            <div class="row contact-form mt-5">
                <div class="col mr-5 ">
                    <form action="" method="post" id="add_supplier_form" class="needs-validation" novalidate enctype="multipart/form-data">
                        <div class="row white-bg">
                            <div class="col-md-6">
                                <div>
                                    <div class="form-group">
                                        <label> <?php echo $lang['SU_NAME'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="name" required maxlength="25" pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$">
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['NAME_VALIED'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['RESPONSIBLE'];?></label>
                                        <div>
                                            <select name="response" id="" class="md-select custom-select"  required>
                                                <option disabled selected value><?php echo $lang['CHOOSE_RESPONSIBLE'];?> </option>
                                                <?php
													foreach($users as $k => $v)
													{
														echo '<option value="'.$v['users_sn'].'">'.$v['users_name'].'</option>';
													}
												?>
                                            </select>
                                        </div>
                                    </div>
<!--
                                    <div class="form-group">
                                        <label> <?php echo $lang['RESPONSIBLE'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="response" required
                                                pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$">
                                                <div class="invalid-feedback">
                                                     <?php echo $lang['NAME_VALIED'];?> 
                                                </div>
                                        </div>
                                    </div>
-->
                                    <div class="form-group">
                                        <label> <?php echo $lang['PHONE'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="phone" required pattern="\d{10,11}">
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['PHONE_VALIED'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['ADDRESS'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="address" required>
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['ADDRESS_VALIED'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CITY'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="city" required>
                                            <div class="invalid-feedback">
                                                <?php echo $lang['CITY_VALIED'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <div class="form-group">
                                        <label><?php echo $lang['SYS_SUPPLY_TYPE'];?></label>
                                        <div>
                                            <select id="select_supply_type" name="supplly_type" id="" class="md-select custom-select" name="supply_type" required>
                                                <option disabled selected value><?php echo $lang['CHOOSE_SUPPLY_TYPE'];?> </option>
                                                <?php
													foreach($supply_type as $k => $v)
													{
														echo '<option value="'.$v['supply_type_sn'].'">'.$v['supply_type_name'].'</option>';
													}
												?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group form_btn">
                                        <?php
                                            if($group['supply_type_add'] == 1){
                                                echo'<button class="dark_btn btn _btn small_btn" type="button" data-toggle="modal" data-target="#AddModalCenter">'.$lang['ADD_SYS_SUPPLY_TYPE'].'</button>';
                                            }
                                        ?>
                                        
                                    </div>
                                    <div class="form-group">
                                        <label> <?php echo $lang['CONTRACT_DATE'];?></label>
                                        <div>
                                            <input id="datepicker7" width="100%" name="start_date" autocomplete="off"  required />
                                            <div class="invalid-feedback">
                                              <?php echo $lang['CONTRACT_DATE_VALIED'];?>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CONTRACT_END'];?></label>
                                        <div>
                                            <input id="datepicker8" width="100%" name="end_date"  autocomplete="off" class="form-control" required />
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['CONTRACT_END_VALIED'];?>
                                             </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['EMAIL'];?></label>
                                        <div>
                                            <input type="email" class="form-control" name="email" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                            <div class="invalid-feedback">
                                              <?php echo $lang['EMAILVALID'];?>
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3 bottom-actions">
                            <div class="col">
                                <button class="btn _btn btn-light darkish-green ml-3" type="submit" ><?php echo $lang['SAVE_ADD_OTHER'];?></button>
                                <button class="btn btn-success _btn darkish-green-bg ml-3" type="submit"><?php echo $lang['SAVE'];?></button>
                                <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" <?php if($car > 0){echo 'href="./add_expenses.php?c='.$car.'"';} ?>><?php echo $lang['CANCEL'];?></a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Add Modal -->
		<div class="modal fade addModal " id="AddModalCenter" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered " role="document">
				<div class="modal-content">
					<div class="modal-header">
						<?php echo $lang['ADD_SYS_SUPPLY_TYPE'];?>
					</div>
					<form  method="post" enctype="multipart/form-data">
						<div class="modal-body ">
								<div class="input-group">
									<label for="exampleInputEmail1"> <?php echo $lang['SYS_SUPPLY_TYPE'];?> </label>
									<input type="text" class="form-control searchInput" id="myInput" aria-label="Text input with segmented dropdown button" placeholder="<?php echo $lang['SYS_SUPPLY_TYPE'];?>" name="name">
									<input type="text" class="form-control" name="in" value="supply_type"  maxlength="25" hidden>
								</div>
						</div>
						<div class="modal-footer">
							<button class="add_name btn btn-success _btn darkish-green-bg ml-3" type="submit" data-dismiss="modal"><?php echo $lang['SAVE'];?></button>
							<a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="#"><?php echo $lang['CANCEL'];?></a>
						</div>
					</form>
				</div>
			</div>
		</div>
    </main>
<?php include './assets/layout/footer.php';?>
<script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');

                    }, false);
                });
            }, false);
        })();


    </script>