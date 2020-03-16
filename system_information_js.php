<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
    if($login->doCheck() == false)
    {
        header("Location:./login.php");
        exit;
    }else{
        switch($_GET['do'])
		{
            case"add_information":
                if($_POST)
                {
                    $company['name']        = sanitize($_POST['name']);
                    $company['address']     = sanitize($_POST['address']);
                    $company['phone']       = sanitize($_POST['phone']);
                    $responce = $informations->setsystemInformation($company);
                    if($responce == 1)
                    {
                        $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	"system_information",
                                    "mode" 		        => 	"edit_company_information",
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                        echo 100;
                    }else{
                        echo 400;
                    }
                    exit;
                }
            break;
            case"add_name":
                if($_POST)
                {
                    $name        = sanitize($_POST['name']);
                    $table       = sanitize($_POST['table']);
                    
                    $check       = $informations->CHECKNewname($table,$name);
                    if($check == 1)
                    {
                        $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	$table,
                                    "mode" 		        => 	"add_in_".$table,
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                        echo $GLOBALS['lang']['INSERT_THIS_NAME_BEFORE'];
                    }else{
                        $responce    = $informations->addNewname($table,$name);
                        if($responce == 1)
                        {
                            echo 100;
                        }
                    }
                     exit;
                }
            break;
            case"select_data":
                if($_POST)
                {
                    $table       = sanitize($_POST['table']);
                    $responce   = $informations->getdatatable($table);
                    foreach($responce as $k => $v)
                    {
                        echo '<option  value="'.$table.'-'.$v[$table.'_sn'].'">'.$v[$table.'_name'].'</option>'; 
                    }
                    
                    exit;
                }
            break;
            case"delete_data_refrish":
                if($_POST)
                {
                    
                    $table       = sanitize($_POST['table']);
                    $responce   = $informations->getdatatable($table);
                    
                    foreach($responce as $k => $v)
                    {
                         echo '<li class="list-group-item"  id="'.'li_'.$table.'-'.$v[$table.'_sn'].'" >'.$v[$table.'_name'].'<i class="delete_name fas fa-trash rose delete_item_icon" id="'.$table.'-'.$v[$table.'_sn'].'"></i></li>';
                    }
                    
                    exit;
                }
            break;    
            case"delete_name":
                if($_POST)
                {
                    $details      = sanitize($_POST['details']);
                    $data         = explode('-',$details);
                    
                    $responce     = $informations->delete_data_from_table($data['0'],$data['1']);
                    if($responce == 1)
                    {
                        $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	$table,
                                    "mode" 		        => 	"delete_from_".$table,
                                    "total" 		    => 	$data['1'],
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                        echo 100;
                    }else{
                        echo 400;
                    }
                    exit;
                }
            break;
            case"edit_name":
                if($_POST)
                {
                    
                    $_details       = sanitize($_POST['details']);
                    $details        = explode('-',$_details);
                    $responce       = $informations->getdatafortable($details[0],$details[1]);
                    echo '<input type="text" id ="'.$table.'_edit_name" class="form-control" placeholder="'.$GLOBALS['lang']['ADD_NAME_'.$name].'" name="name" value="'.$responce['name'].'" maxlength="25">
                          <input type="text" id ="'.$table.'_edit_id" class="form-control" placeholder="'.$GLOBALS['lang']['ADD_NAME_'.$name].'" maxlength="25" name="id" value="'.$responce['id'].'" hidden>';
                    exit;
                }
            break;
            case"update_name":
                if($_POST)
                {
                    $data['name']        = sanitize($_POST['name']);
                    $data['id']          = sanitize($_POST['id']);
                    $table               = sanitize($_POST['table']);
                    
                    $check       = $informations->CHECKNewname($table,$data['name']);
                    if($check == 1)
                    {
                        echo $GLOBALS['lang']['INSERT_THIS_NAME_BEFORE'];
                    }else{
                        $responce    = $informations->set_data_in_table($table,$data);
                        if($responce == 1)
                        {
                            $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	$table,
                                    "mode" 		        => 	"edit_in_".$table,
                                    "total" 		    => 	$data['id'],
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                            echo 100;
                        }
                    }
                     exit;
                }
            break;    
            case"upload_logo":
                    if( $_FILES && ( $_FILES['image']['name'] != "") && ( $_FILES['image']['tmp_name'] != "" ) )
                    {
                        include_once("./inc/Classes/upload.class.php");

                        $allow_ext = array("jpg","jpeg","gif","png");

                        $upload    = new Upload($allow_ext,false,174,44,5000,$upload_path,".","",false);

                        $files['name'] 	= addslashes($_FILES["image"]["name"]);
                        $files['type'] 	= $_FILES["image"]['type'];
                        $files['size'] 	= $_FILES["image"]['size']/1024;
                        $files['tmp'] 	= $_FILES["image"]['tmp_name'];
                        $files['ext']		= $upload->GetExt($_FILES["image"]["name"]);

                        $upfile	= $upload->Upload_File($files);
                        

                        if($upfile)
                        {
                            $image = $upfile['newname'];
                            $responce    = $informations->set_logo_data($image);
                            if($responce == 1)
                            {
                                $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	"update_logo",
                                    "mode" 		        => 	"update_logo",
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                                echo 100;
                            }
                        }else
                        {
                           echo $lang['UP_ERR_NOT_UPLODED'];
                        }
                        @unlink($path.$u['company_information_photo']);
                    }
                 exit;
            break; 
            case"delete_data":
                if($_POST)
                {
                    $permission         = sanitize($_POST['permission']);
                    $mId                = intval($_POST['id']);
                    $table              = sanitize($_POST['table']);
                    
                    if($group[$permission] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    {    
                        $delete = $informations->deleterowfromtable($table,$mId);
                        $logs->addLog(NULL,
                                    array(
                                        "type" 		        => 	"user",
                                        "module" 	        => 	$table,
                                        "mode" 		        => 	"delete",
                                        "total" 		    => 	$mId,
                                        "id" 	        	=>	$_SESSION['id'],
                                    ),"user",$_SESSION['id'],1
                                );
                        if($delete == 1)
                        {
                          
                            echo 100;
                            exit;
                        }
                    }
                }
            break;  
            case"add_group":
                if($_POST)
                {
                    $group['groups_name']                = sanitize($_POST['name']);
                    $group['groups_notes']               = sanitize($_POST['description']);
                    
                    if($group["contacts_add"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
                        $check = $informations->isgroupsExists($group);
                        if($check == 0)
                        {
                            $add   = $informations->addNewgroups($group);
                            $logs->addLog(NULL,
                                        array(
                                            "type" 		        => 	"user",
                                            "module" 	        => 	"group",
                                            "mode" 		        => 	"add",
                                            "id" 	        	=>	$_SESSION['id'],
                                        ),"user",$_SESSION['id'],1
                                    );
                            if($add == 1)
                            {

                                echo 100;
                                exit;
                            }
                        }else{
                            echo 400;
                            exit;
                        }
                        
                    }
                }
            break; 
            case"edit_group":
                if($_POST)
                {
                    $group['groups_sn']                  = intval($_POST['id']);
                    $group['groups_name']                = sanitize($_POST['name']);
                    $group['groups_notes']               = sanitize($_POST['description']);
                    if($group["contacts_edit"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
                        $check = $informations->isgroupsExists($group);
                        if ($check > 0)
                        {
                            if($check == $group['groups_sn'])
                            {
                                $update   = $informations->setgroupsInformation($group);
                                $logs->addLog(NULL,
                                            array(
                                                "type" 		        => 	"user",
                                                "module" 	        => 	"group",
                                                "mode" 		        => 	"update",
                                                "total" 		    => 	$group['groups_sn'],
                                                "id" 	        	=>	$_SESSION['id'],
                                            ),"user",$_SESSION['id'],1
                                        );
                                if($update == 1)
                                {

                                    echo 100;
                                    exit;
                                }  
                            }else{
                                echo 400;
                                exit;
                            }
                        }else{
                            $update   = $informations->setgroupsInformation($group);
                                $logs->addLog(NULL,
                                            array(
                                                "type" 		        => 	"user",
                                                "module" 	        => 	"group",
                                                "mode" 		        => 	"update",
                                                "total" 		    => 	$group['groups_sn'],
                                                "id" 	        	=>	$_SESSION['id'],
                                            ),"user",$_SESSION['id'],1
                                        );
                                if($update == 1)
                                {

                                    echo 100;
                                    exit;
                                } 
                        }
                        
                        
                    }
                }
            break;
				
			//****************** expenses ************************//	
			case"add_expenses":
                if($_POST)
                {
                    $expenses['expenses_name']                = sanitize($_POST['name']);
                    if($group["expenses_add"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
                        $check = $informations->isexpensesExists($expenses['expenses_name']);
                        if (!$check)
                        {
							$add   = $informations->addNewexpenses($expenses);
							$logs->addLog(NULL,
										array(
											"type" 		        => 	"user",
											"module" 	        => 	"expenses",
											"mode" 		        => 	"add",
											"id" 	        	=>	$_SESSION['id'],
										),"user",$_SESSION['id'],1
									);
							if($add == 1)
							{
								echo 100;
								exit;
							}  
                        }else{
                                echo 400;
                                exit;
                            }
                    }
                }
            break;	
			case"edit_expenses":
                if($_POST)
                {
                    $expenses['expenses_sn']                  = intval($_POST['id']);
                    $expenses['expenses_name']                = sanitize($_POST['name']);
                    if($group["expenses_edit"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
                        $check = $informations->isexpensesExists($expenses['expenses_name']);
                        if ($check > 0)
                        {
                            if($check == $expenses['expenses_sn'])
                            {
                                $update   = $informations->setexpensesInformation($expenses);
                                $logs->addLog(NULL,
                                            array(
                                                "type" 		        => 	"user",
                                                "module" 	        => 	"expenses",
                                                "mode" 		        => 	"update",
                                                "total" 		    => 	$expenses['expenses_sn'],
                                                "id" 	        	=>	$_SESSION['id'],
                                            ),"user",$_SESSION['id'],1
                                        );
                                if($update == 1)
                                {

                                    echo 100;
                                    exit;
                                }  
                            }else{
                                echo 400;
                                exit;
                            }
                        }else{
                            $update   = $informations->setexpensesInformation($expenses);
                                $logs->addLog(NULL,
                                            array(
                                                "type" 		        => 	"user",
                                                "module" 	        => 	"expenses",
                                                "mode" 		        => 	"update",
                                                "total" 		    => 	$expenses['expenses_sn'],
                                                "id" 	        	=>	$_SESSION['id'],
                                            ),"user",$_SESSION['id'],1
                                        );
                                if($update == 1)
                                {

                                    echo 100;
                                    exit;
                                } 
                        }
                        
                        
                    }
                }
            break;
			case"delete_expenses":
                if($_POST)
                {
                    $id                  = intval($_POST['id']);
                    if($group["expenses_delete"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
						$delete   = $informations->deleteexpenses($id);
						$logs->addLog(NULL,
									array(
										"type" 		        => 	"user",
										"module" 	        => 	"expenses",
										"mode" 		        => 	"delete",
										"total" 		    => 	$id,
										"id" 	        	=>	$_SESSION['id'],
									),"user",$_SESSION['id'],1
								);
						if($delete == 1)
						{
							echo 100;
							exit;
						}  
                    }
                }
            break;
            //***************** project routes *****************//
            case"route":
                if($_POST)
                {
                     $project        = intval($_POST['project']);
                     $routes         = $informations->getprojectroutes($project);
//                    echo'<label>'.$lang['ROUTE'].'</label>
//                        <select data-live-search="true"  class="route form-control selectpicker custom-select" title="'.$lang['PROJECT_FIRST'].'" name="road" required>';
                        if(is_array($routes))
                        {
                            foreach($routes as $k => $r)
                            {
                                echo '<option value="'.$r['project_roads_sn'].'">'.$r['project_roads_code'].'</option>';
                            }
                        }else{
                            echo '<option value="">'.$lang['NO_ROUTE_PROJECT'].'</option>';
                        }
                        
//                    echo '</select>';
                }
            break;
                
            // ******************** services ****************//
            case"delete_services":
                if($_POST)
                {
                    $id                  = intval($_POST['id']);
                    if($group["services_delete"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
						$delete   = $informations->deleteservices($id);
						$logs->addLog(NULL,
									array(
										"type" 		        => 	"user",
										"module" 	        => 	"services",
										"mode" 		        => 	"delete",
										"total" 		    => 	$id,
										"id" 	        	=>	$_SESSION['id'],
									),"user",$_SESSION['id'],1
								);
						if($delete == 1)
						{
							echo 100;
							exit;
						}  
                    }
                }
            break;  
			
			// ****************** car_damage *************** //
			case"end_damage":
                if($_POST)
                {
                    $id                  = intval($_POST['id']);
                    if($group["end_check"] == 0){
                        header("Location:./permission.php");
                        exit;
                    }else
                    { 
						$end   = $informations->end_damage($id);
						$logs->addLog(NULL,
									array(
										"type" 		        => 	"user",
										"module" 	        => 	"car_damage",
										"mode" 		        => 	"end",
										"total" 		    => 	$id,
										"id" 	        	=>	$_SESSION['id'],
									),"user",$_SESSION['id'],1
								);
						if($end == 1)
						{
							echo 100;
							exit;
						}  
                    }
                }
            break;
                
            //***************** max_car_type ************* //
           case"type_max":
                if($_POST)
                {
                    $id      = intval($_POST['id']);
                    $total   = $informations->gettype_max($id);
                    if($total > 0){
                        echo $total;
                        exit;
                    }else{
                        
                        echo $lang['NO_CAR_IN_THIS_TYPE'];
                        exit;
                    }
                }
            break;
        }
    }
?>



