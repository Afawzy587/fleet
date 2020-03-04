<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemusers
{
	var $tableName 	= "users";

	function getsiteusers($addon = "")
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `users_sn` !='".$_SESSION['id']."' ORDER BY `users_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}
	function getselectusers()
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `users_sn`  DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotalusers($addon = "")
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `users_sn` !='".$_SESSION['id']."'");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getusersInformation($users_sn)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `users_sn` = '".$users_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitegroup = $GLOBALS['db']->fetchitem($query);
            return array(
                "users_sn"			            => 		$siteusers['users_sn'],
                "users_name"			        => 		$siteusers['users_name'],
                "users_managment_id"			=> 		$siteusers['users_managment_id'],
                "users_job_id"			        => 		$siteusers['users_job_id'],
                "users_qualification"			=> 		$siteusers['users_qualification'],
                "users_birthday"			    => 		$siteusers['users_birthday'],
                "users_hiring_date"			    => 		$siteusers['users_hiring_date'],
                "users_phone"			        => 		$siteusers['users_phone'],
                "users_email"			        => 		$siteusers['users_email'],
                "users_net_salary"			    => 		$siteusers['users_job_serial'],
                "users_email"			        => 		$siteusers['users_net_salary'],
                "users_salary_exchanges"		=> 		$siteusers['users_salary_exchanges'],
                "users_photo"			        => 		$siteusers['users_photo'],
                "users_personal_id"			    => 		$siteusers['users_personal_id'],
                "users_license_id"			    => 		$siteusers['users_license_id'],
                "users_license_place"			=> 		$siteusers['users_license_place'],
                "users_license_expired"			=> 		$siteusers['users_license_expired'],
                "users_contract_finish"			=> 		$siteusers['users_contract_finish'],
                "users_contract_photo"			=> 		$siteusers['users_contract_photo'],
                "users_notes"			        => 		$siteusers['users_notes'],
                "users_username"			    => 		$siteusers['users_username'],
                "users_group_id"			    => 		$siteusers['users_group_id'],
                "users_last_login"			    => 		$siteusers['users_last_login'],
                "users_status"			        => 		$siteusers['users_status'],
                "users_kick"			        => 		$siteusers['users_kick']
            );
        }else{return null;}
	}
	
	function isusersExists($name)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `users_name` = '".$name."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $siteusers = $GLOBALS['db']->fetchitem($query);
            return array(
                "users_sn"			            => 		$siteusers['users_sn']
            );


        }else{return true;}
	}

	function setusersInformation($users)
	{
        if($users['users_photo'] != "")
		{
			$users_photo = "`users_photo`='".$users['users_photo']."',";
		}else
		{
			$users_photo = "";
		}
		
		 if($users['users_personal_id'] != "")
		{
			$users_personal_id = "`users_personal_id`='".$users['users_personal_id']."',";
		}else
		{
			$users_personal_id = "";
		}
		 if($users['users_contract_photo'] != "")
		{
			$users_contract_photo = "`users_contract_photo`='".$users['users_contract_photo']."',";
		}else
		{
			$users_contract_photo = "";
		}
	    if($users['users_password'] != "")
		{
			$users_password = "`users_password`='".$users['users_password']."',";
		}else
		{
			$users_password = "";
		}
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `users_name`			        = 		'".$users['users_name']."',".$users_password."
            `users_managment_id`			= 		'".$users['users_managment_id']."',".$users_contract_photo."
            `users_job_id`			        = 		'".$users['users_job_id']."',".$users_personal_id."
            `users_qualification`			= 		'".$users['users_qualification']."',".$users_photo."
            `users_birthday`			    = 		'".$users['users_birthday']."',
            `users_hiring_date`			    = 		'".$users['users_hiring_date']."',
            `users_phone`			        = 		'".$users['users_phone']."',
            `users_email`			        = 		'".$users['users_email']."',
            `users_net_salary`			    = 		'".$users['users_job_serial']."',
            `users_email`			        = 		'".$users['users_net_salary']."',
            `users_salary_exchanges`		= 		'".$users['users_salary_exchanges']."',
            `users_license_id`			    = 		'".$users['users_license_id']."',
            `users_license_place`			= 		'".$users['users_license_place']."',
            `users_license_expired`			= 		'".$users['users_license_expired']."',
            `users_contract_finish`			= 		'".$users['users_contract_finish']."',
            `users_notes`			        = 		'".$users['users_notes']."',
            `users_username`			    = 		'".$users['users_username']."',
            `users_group_id`			    = 		'".$users['users_group_id']."'
          WHERE `users_sn`    	            = 	    '".$users['users_sn']."' LIMIT 1 ");
		return 1;
	}

	function addNewusers($users)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`users_sn`, `users_name`, `users_managment_id`, `users_job_id`, `users_qualification`, `users_birthday`,
        `users_hiring_date`, `users_phone`, `users_email`, `users_job_serial`, `users_net_salary`, `users_salary_exchanges`, 
        `users_photo`, `users_personal_id`, `users_license_id`, `users_license_place`, `users_license_expired`, `users_contract_finish`,
        `users_contract_photo`, `users_notes`, `users_username`, `users_password`, `users_group_id`,`users_status`, `users_kick`)
		VALUES ( NULL ,  '".$users['users_name']."' ,  '".$users['users_managment_id']."',  '".$users['users_job_id']."' ,  '".$users['users_qualification']."',  '".$users['users_birthday']."' , 
        '".$users['users_hiring_date']."','".$users['users_phone']."' ,  '".$users['users_email']."',  '".$users['users_job_serial']."' ,  '".$users['users_net_salary']."',  '".$users['users_salary_exchanges']."' , 
        '".$users['users_photo']."','".$users['users_personal_id']."' ,  '".$users['users_license_id']."',  '".$users['users_license_place']."' ,  '".$users['users_license_expired']."',  '".$users['users_contract_finish']."', 
        '".$users['users_contract_photo']."','".$users['users_notes']."' ,  '".$users['users_username']."',  '".$users['users_password']."' ,  '".$users['users_group_id']."','1', 1 )");
		return 1;
	}

	

}
?>
