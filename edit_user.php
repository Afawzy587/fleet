<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    include("./inc/Classes/system-groups.php");
	$groups = new systemgroups();

    include("./inc/Classes/system-users.php");
	$users = new systemusers();
    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
        $managements   = $informations->getdatatable("management");                                            // management
        $job_type      = $informations->getdatatable("job_type");                                             // job_type
        $groups        = $groups->getsitegroups();                                                           // groups
            if($group['contacts_edit'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
				if (intval($_GET['id']) != 0)
				{
					$u = $users->getusersInformation($_GET['id']);

					if($_POST)
					{

						$_user['users_sn']                       =       intval($_GET['id']);
						$_user['users_name']                     =       sanitize($_POST["name"]);
						$_user['users_managment_id']             =       intval($_POST["mangment"]);
						$_user['users_job_id']                   =       intval($_POST["job"]);
						$_user['users_qualification']            =       sanitize($_POST["qualification"]);
						$_user['users_birthday']                 =       format_data_base(sanitize($_POST["birthday"]));
						$_user['users_hiring_date']              =       format_data_base(sanitize($_POST["hiring_date"]));
						$_user['users_phone']                    =       sanitize($_POST["phone"]);
						$_user['users_email']                    =       sanitize($_POST["email"]);
						$_user['users_job_serial']               =       sanitize($_POST["serial"]);
						$_user['users_net_salary']               =       floatval($_POST["salary"]);
						$_user['users_salary_exchanges']         =       floatval($_POST["bouns"]);
						$_user['users_license_id']               =       intval($_POST["license_id"]);
						$_user['users_license_place']            =       sanitize($_POST["licence_place"]);
						$_user['users_license_expired']          =       format_data_base(sanitize($_POST["license_expired"]));
						$_user['users_contract_finish']          =       format_data_base(sanitize($_POST["contract_end"]));
						$_user['users_notes']                    =       sanitize($_POST["notes"]);
						$_user['users_username']                 =       sanitize($_POST["user_name"]);
						if(sanitize($_POST["password"]) != "")
						{
							$_user['users_password']              =       password_hash(sanitize($_POST["password"]),PASSWORD_DEFAULT);
						}else
						{
							$_user['users_password']              = "";
						}
						$_user['users_group_id']                 =       intval($_POST["group_id"]);
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
								$_user['users_photo']  = $upfile['newname'];

							}
						}
						if( $_FILES && ( $_FILES['personal_id']['name'] != "") && ( $_FILES['personal_id']['tmp_name'] != "" ) )
						{
							include_once("./inc/Classes/upload.class.php");
							$allow_ext = array("jpg","jpeg","gif","png");
							$upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
							$files['name'] 	= addslashes($_FILES["personal_id"]["name"]);
							$files['type'] 	= $_FILES["personal_id"]['type'];
							$files['size'] 	= $_FILES["personal_id"]['size']/1024;
							$files['tmp'] 	= $_FILES["personal_id"]['tmp_name'];
							$files['ext']		= $upload->GetExt($_FILES["personal_id"]["name"]);
							$upfile	= $upload->Upload_File($files);
							if($upfile)
							{
								$_user['users_personal_id']  = $upfile['newname'];

							}
						}
						if( $_FILES && ( $_FILES['contract_img']['name'] != "") && ( $_FILES['contract_img']['tmp_name'] != "" ) )
						{
							include_once("./inc/Classes/upload.class.php");
							$allow_ext = array("jpg","jpeg","gif","png");
							$upload    = new Upload($allow_ext,false,0,0,5000,$upload_path,".","",false);
							$files['name'] 	= addslashes($_FILES["contract_img"]["name"]);
							$files['type'] 	= $_FILES["contract_img"]['type'];
							$files['size'] 	= $_FILES["contract_img"]['size']/1024;
							$files['tmp'] 	= $_FILES["contract_img"]['tmp_name'];
							$files['ext']		= $upload->GetExt($_FILES["contract_img"]["name"]);
							$upfile	= $upload->Upload_File($files);
							if($upfile)
							{
								$_user['users_contract_photo']  = $upfile['newname'];

							}
						}

						$edit = $users->setusersInformation($_user);
                        if($edit == 1)
						{
                            header("Location:./users.php?message=update");
						}


					}
				}else{
                	header("Location:./error.php");
                	exit;
            	}
            }
        include './assets/layout/header.php';
        include './assets/layout/navbar.php';
    }
?>
<main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h1 class="h2"><?php echo $lang['CONT_TITLE'];?></h1>
            

        </div>
        <div class="container page_body">
            <form class="addContactForm needs-validation" method="post" name="addContactForm" enctype="multipart/form-data" novalidate>
                <div class="row">
                    <div class="col white-bg mr-4 contact-header">
                        <div>
                            <img class="rounded-circle" height="50" src="<?php echo $path.$u['users_photo'];?>" alt="profile-pic">
                            <div class="contact-info">
                                <h5><?php echo $u['users_name'];?></h5>
                                <p class="tangerine"><?php echo $u['users_job_id'];?></p>
                            </div>
                        </div>
                        <div>
                            <button class="btn _btn btn-danger rose-bg mr-3" id="myButton" ><?php echo $lang['CANCEL'];?></button>
                            <button class="btn btn-success _btn darkish-green-bg mr-3" type="submit"><?php echo $lang['SAVE'];?></button>
                        </div>
                    </div>
                </div>
                <div class="row contact-form">
                <div class="col mr-2">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="small_title"><?php echo $lang['MAIN_DATA'] ;?></h3>
                                <div class="white-bg">
                                    <div class="form-group">
                                        <label><?php echo $lang['NAME']; ?></label>
                                        <div>
                                            <input type="text" class="form-control" name="name" value="<?php echo $u['users_name'];?>" required pattern="^[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z]+[\u0600-\u065F\u066A-\u06EF\u06FA-\u06FFa-zA-Z-_]*$">
                                            <div class="invalid-feedback">
                                                <?php echo $lang['INSERT_NAME']; ?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label><?php echo $lang['SYS_MANAGEMENT']; ?></label>
                                        <select  class="md-select custom-select" name="mangment" required>
                                            <option disabled selected value> <?php echo $lang['CHOOSE_MANGMENT'];?> </option>
                                            <?php
                                             foreach ($managements as $k => $v)
                                             {
                                                 echo '<option value="'.$v['management_sn'].'"';if($u['users_managment_id'] ==$v['management_sn']){echo "selected";}echo'>'.$v['management_name'].'</option>';
                                             }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['JOB'];?></label>
                                        <select  class="md-select custom-select" name="job" required>
                                            <option disabled selected value>  <?php echo $lang['CHOOSE_JOB'];?> </option>
                                            <?php
                                             foreach ($job_type as $k => $v)
                                             {
                                                 echo '<option value="'.$v['job_type_sn'].'"';if($u['users_job_id'] ==$v['job_type_sn']){echo "selected";}echo'>'.$v['job_type_name'].'</option>';
                                             }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['QUAL'] ; ?></label>
                                        <div>
                                            <input type="text" class="form-control" name="qualification" value="<?php echo $u['users_qualification'] ; ?>" required  maxlength="15">
                                            <div class="invalid-feedback">
                                                   <?php echo $lang['INSERT_QUEL'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['BARTHDAY'];?></label>
                                        <input id="datepicker1" width="100%" name="birthday" value="<?php echo _date_format($u['users_birthday']) ; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['HIRING_DATE'];?></label>
                                        <input id="datepicker2" width="100%" name="hiring_date" value="<?php echo _date_format($u['users_hiring_date']) ; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['PHONE'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="phone" value="<?php echo $u['users_phone'] ; ?>" required pattern="\d{10,11}">
                                            <div class="invalid-feedback">
                                                   <?php echo $lang['INSERT_PHONE'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['EMAIL'];?></label>
                                        <div>
                                            <input type="email" class="form-control"  autocomplete="new-password" name="email" value="<?php echo $u['users_email'] ; ?>" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                            <div class="invalid-feedback">
                                                <?php echo $lang['INSERT_EMAIL'];?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3 class="small_title"><?php echo $lang['WORK_INFORMATION'];?></h3>
                                <div class="white-bg">
                                    <div class="form-group">
                                        <label><?php echo $lang['JOB_SERIAL'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="serial" value="<?php echo $u['users_job_serial'] ; ?>" pattern="\d{1,4}" required maxlength="4">
                                            <div class="invalid-feedback">
                                                    <?php echo $lang['INSERT_JOB_SERIAL'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['NET_SALARY'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="salary" value="<?php echo $u['users_net_salary'] ; ?>" required pattern="\d*">
                                            <div class="invalid-feedback">
                                                     <?php echo $lang['INSERT_NET_SALARY'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['BOUNS'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="bouns" value="<?php echo $u['users_salary_exchanges'] ; ?>" required pattern="\d*">
                                            <div class="invalid-feedback">
                                                  <?php echo $lang['INSERT_BOUNS'];?>  
                                             </div>
                                        </div>
                                    </div>
<!--
                                    <div class="form-group">
                                        <div class="custom-file custom_file2">
                                            <input type="file" name="photo" class="custom-file-input custom_file2-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
                                            <label class="custom-file2-label" for="inputGroupFile01"><?php echo $lang['PERSONAL_IMG'];?></label>
                                        </div>
                                        <div class="preview">
                                            <img src="upload/default.png" id="img" width="130" height="170">
                                        </div>
                                    </div>
-->
                                    <div class="form-group">
                                        <!-- <div class="custom-file custom_file2"> -->
                                        <!-- <input type="file" class="custom-file-input custom_file2-input"
                                                id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required> -->
                                        <label><?php echo $lang['PERSONAL_IMG'];?>
                                        </label>
                                        <!-- </div> -->
                                        <div class="preview id_image_preview">
                                            <!-- <img src="" id="img" width="130" height="170"> -->

                                            <div class="avatar-upload">
                                                <div class="avatar-edit">
                                                    <input type='file' name="photo" id="imageUpload" accept=".png, .jpg, .jpeg" />
                                                    <label for="imageUpload"><i class="fa fa-upload"></i></label>
                                                </div>
                                                <div class="avatar-preview">
                                                    <div id="imagePreview"
                                                        style="background-image: url(<?php echo $path.$u['users_photo'] ; ?>);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group attachement">
                                        <div class="custom-file">
                                            <input type="file" name="personal_id" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"  required>
                                            <label class="custom-file-label" for="inputGroupFile01"> </label>
                                        </div>
                                        <label> <?php echo $lang['PERSONAL_ID_IMG'];?></label>
                                        <div class="uploaded_img_url"></div>
                                        <div class="invalid-feedback id_image">
                                            <?php echo $lang['INSERT_PERSONAL_ID'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h3 class="small_title"><?php echo $lang['DOC_INFORMATION'];?></h3>
                                <div class="white-bg">
                                    <div class="form-group">
                                        <label><?php echo $lang['LICENSE_NUM'];?> </label>
                                        <div>
                                            <input type="text" class="form-control" name="license_id" value="<?php echo $u['users_license_id'] ; ?>" required pattern="\d{10}">
                                            <div class="invalid-feedback">
                                                    <?php echo $lang['INSERT_LICENSE_ID'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['LICENSE_PLACE'];?> </label>
                                        <div>
                                            <input type="text" class="form-control" name="licence_place"  value="<?php echo $u['users_license_place'] ; ?>" required maxlength="175">
                                            <div class="invalid-feedback">
                                                   <?php echo $lang['INSER_LICENSE_PLACE'];?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['LICENSE_EXPIRED'];?> </label>
                                        <input id="datepicker3" width="100%" name="license_expired" value="<?php echo _date_format($u['users_license_expired']); ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['CONTRACT_END'];?></label>
                                        <input id="datepicker4" width="100%" name="contract_end" value="<?php echo _date_format($u['users_contract_finish']) ; ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['NOTES'];?> </label>
                                        <textarea name="notes" id="" rows="6" class="form-control custom-textarea-height"><?php echo $u['users_notes'] ; ?></textarea>
                                    </div>
                                    <div class="input-group attachement">
                                        <div class="input-group-prepend">
                                            <!-- <span class="input-group-text" id="inputGroupFileAddon01">Upload</span> -->
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" name="contract_img" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="contract_img" required>
                                            <label class="custom-file-label" for="inputGroupFile01"> </label>
                                        </div>
                                        <label><?php echo $lang['CONTRACT_IMG'];?> </label>
                                        <!-- <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01"> -->
                                        <div class="uploaded_img_url"></div>
                                        <div class="invalid-feedback required_attachment">
                                            <?php echo $lang['INSERT_CONTRACT_IMAGE'];?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h3 class="small_title"><?php echo $lang['ACOUNT_INFORMATION'];?></h3>
                                <div class="white-bg bottom-contact-form">
                                    <div class="form-group col-md-4">
                                        <label><?php echo $lang['USER_NAME'];?></label>
                                        <div>
                                            <input type="text" class="form-control" name="user_name" value="<?php echo $u['users_username'] ; ?>" autocomplete="new-password" required maxlength="25" >
                                            <div class="invalid-feedback">
                                                 <?php echo $lang['INSERT_USERNAME'];?>   
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $lang['PASS_WORD'];?></label>
                                        <div>
                                            <input type="password" class="form-control" name="password" autocomplete="new-password" required id="password" minlength="8">
                                            <p class="help-block"><?php echo $lang['NOCHANGEINPASS'];?></p>
                                            <div class="invalid-feedback">
                                                <?php echo $lang['NOT_CORRECT_PASS'];?>
                                                </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-4">
                                        <label><?php echo $lang['REPEAT'];?> </label>
                                        <div>
                                            <input type="password" class="form-control" name="confirmpassword"  id="confirmpassword" autocomplete="new-password" required onchange="confirmpasswordvalidation()">
                                            <div class="invalid-feedback confirmpassword " id="confirmpasswordField">
                                                     <?php echo $lang['NOT_SAME'];?>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label><?php echo $lang['US_GROUPS'];?> </label>
                                        <select name="group_id" id="" class="md-select" >
                                            <option disabled selected value>  <?php echo $lang['CHOOSE_GROUP'];?> </option>
                                            <?php
                                              foreach( $groups as $k => $v)
                                              {
                                                  echo '<option value="'.$v['groups_sn'].'"';if($u['users_group_id'] ==$v['groups_sn']){echo "selected";}echo'>'.$v['groups_name'].'</option>';
                                              }
                                            ?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>
<script>
 <script>
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        // confirmPassvalidate();
                        attachmentvalidation();
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');

                    }, false);
                });
            }, false);
        })();



        function confirmpasswordvalidation() {

            var pass = document.getElementById("password").value
            var confPass = document.getElementById("confirmpassword");
            console.log('check');
            // confPass_filed = document.getElementById("confirmpassword");
            if (pass != confPass.value || confPass.value == "") {
                console.log('error');

                confPass.setCustomValidity("Invalid field.");
            } else confPass.setCustomValidity("");
        };


        function attachmentvalidation() {
            var att = document.getElementsByClassName("custom-file-input");
            for (let index = 0; index < att.length; index++) {
                const element = att[index];
                if (element.value == "") {
                    element.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.classList.add('d-block');
                } else element.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.classList.remove('d-block')
            }
        }
    


    </script>

    <script type="text/javascript">
        document.getElementById("myButton").onclick = function () {
            location.href = "./users.php";
        };
    </script>