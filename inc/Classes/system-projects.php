<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemprojects
{
	var $tableName 	= "projects";

	function getsiteprojects($addon = "")
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `projects_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}
	function getselectprojects()
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `projects_sn`  DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotalprojects($addon = "")
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `projects_sn` !='".$_SESSION['id']."'");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getprojectsInformation($projects_sn)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `projects_sn` = '".$projects_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitegroup = $GLOBALS['db']->fetchitem($query);
            return array(
                "projects_sn"			            => 		$siteprojects['projects_sn'],
                "projects_name"			        => 		$siteprojects['projects_name'],
                "projects_managment_id"			=> 		$siteprojects['projects_managment_id'],
                "projects_job_id"			        => 		$siteprojects['projects_job_id'],
                "projects_qualification"			=> 		$siteprojects['projects_qualification'],
                "projects_birthday"			    => 		$siteprojects['projects_birthday'],
                "projects_hiring_date"			    => 		$siteprojects['projects_hiring_date'],
                "projects_phone"			        => 		$siteprojects['projects_phone'],
                "projects_email"			        => 		$siteprojects['projects_email'],
                "projects_net_salary"			    => 		$siteprojects['projects_job_serial'],
                "projects_email"			        => 		$siteprojects['projects_net_salary'],
                "projects_salary_exchanges"		=> 		$siteprojects['projects_salary_exchanges'],
                "projects_photo"			        => 		$siteprojects['projects_photo'],
                "projects_personal_id"			    => 		$siteprojects['projects_personal_id'],
                "projects_license_id"			    => 		$siteprojects['projects_license_id'],
                "projects_license_place"			=> 		$siteprojects['projects_license_place'],
                "projects_license_expired"			=> 		$siteprojects['projects_license_expired'],
                "projects_contract_finish"			=> 		$siteprojects['projects_contract_finish'],
                "projects_contract_photo"			=> 		$siteprojects['projects_contract_photo'],
                "projects_notes"			        => 		$siteprojects['projects_notes'],
                "projects_username"			    => 		$siteprojects['projects_username'],
                "projects_group_id"			    => 		$siteprojects['projects_group_id'],
                "projects_last_login"			    => 		$siteprojects['projects_last_login'],
                "projects_status"			        => 		$siteprojects['projects_status'],
                "projects_kick"			        => 		$siteprojects['projects_kick']
            );
        }else{return null;}
	}
	
	function isprojectsExists($name)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `projects_name` = '".$name."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $siteprojects = $GLOBALS['db']->fetchitem($query);
            return array(
                "projects_sn"			            => 		$siteprojects['projects_sn']
            );


        }else{return true;}
	}

	function setprojectsInformation($projects)
	{
        if($projects['projects_photo'] != "")
		{
			$projects_photo = "`projects_photo`='".$projects['projects_photo']."',";
		}else
		{
			$projects_photo = "";
		}
		
		 if($projects['projects_personal_id'] != "")
		{
			$projects_personal_id = "`projects_personal_id`='".$projects['projects_personal_id']."',";
		}else
		{
			$projects_personal_id = "";
		}
		 if($projects['projects_contract_photo'] != "")
		{
			$projects_contract_photo = "`projects_contract_photo`='".$projects['projects_contract_photo']."',";
		}else
		{
			$projects_contract_photo = "";
		}
	    if($projects['projects_password'] != "")
		{
			$projects_password = "`projects_password`='".$projects['projects_password']."',";
		}else
		{
			$projects_password = "";
		}
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `projects_name`			        = 		'".$projects['projects_name']."',".$projects_password."
            `projects_managment_id`			= 		'".$projects['projects_managment_id']."',".$projects_contract_photo."
            `projects_job_id`			        = 		'".$projects['projects_job_id']."',".$projects_personal_id."
            `projects_qualification`			= 		'".$projects['projects_qualification']."',".$projects_photo."
            `projects_birthday`			    = 		'".$projects['projects_birthday']."',
            `projects_hiring_date`			    = 		'".$projects['projects_hiring_date']."',
            `projects_phone`			        = 		'".$projects['projects_phone']."',
            `projects_email`			        = 		'".$projects['projects_email']."',
            `projects_net_salary`			    = 		'".$projects['projects_job_serial']."',
            `projects_email`			        = 		'".$projects['projects_net_salary']."',
            `projects_salary_exchanges`		= 		'".$projects['projects_salary_exchanges']."',
            `projects_license_id`			    = 		'".$projects['projects_license_id']."',
            `projects_license_place`			= 		'".$projects['projects_license_place']."',
            `projects_license_expired`			= 		'".$projects['projects_license_expired']."',
            `projects_contract_finish`			= 		'".$projects['projects_contract_finish']."',
            `projects_notes`			        = 		'".$projects['projects_notes']."',
            `projects_username`			    = 		'".$projects['projects_username']."',
            `projects_group_id`			    = 		'".$projects['projects_group_id']."'
          WHERE `projects_sn`    	            = 	    '".$projects['projects_sn']."' LIMIT 1 ");
		return 1;
	}

	function addNewprojects($projects)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`projects_sn`, `projects_name`, `projects_managment_id`, `projects_job_id`, `projects_qualification`, `projects_birthday`,
        `projects_hiring_date`, `projects_phone`, `projects_email`, `projects_job_serial`, `projects_net_salary`, `projects_salary_exchanges`, 
        `projects_photo`, `projects_personal_id`, `projects_license_id`, `projects_license_place`, `projects_license_expired`, `projects_contract_finish`,
        `projects_contract_photo`, `projects_notes`, `projects_username`, `projects_password`, `projects_group_id`,`projects_status`, `projects_kick`)
		VALUES ( NULL ,  '".$projects['projects_name']."' ,  '".$projects['projects_managment_id']."',  '".$projects['projects_job_id']."' ,  '".$projects['projects_qualification']."',  '".$projects['projects_birthday']."' , 
        '".$projects['projects_hiring_date']."','".$projects['projects_phone']."' ,  '".$projects['projects_email']."',  '".$projects['projects_job_serial']."' ,  '".$projects['projects_net_salary']."',  '".$projects['projects_salary_exchanges']."' , 
        '".$projects['projects_photo']."','".$projects['projects_personal_id']."' ,  '".$projects['projects_license_id']."',  '".$projects['projects_license_place']."' ,  '".$projects['projects_license_expired']."',  '".$projects['projects_contract_finish']."', 
        '".$projects['projects_contract_photo']."','".$projects['projects_notes']."' ,  '".$projects['projects_username']."',  '".$projects['projects_password']."' ,  '".$projects['projects_group_id']."','1', 1 )");
		return 1;
	}

	function deleteprojects($projects_sn)
	{
		$GLOBALS['db']->query("DELETE LOW_PRIORITY FROM `".$this->tableName."` WHERE `projects_sn` = '".$projects_sn."' LIMIT 1 ");
		return 1;
	}
	
	function activestatusprojects($projects_sn,$status)
	{  
		if($status==1)
		{
			$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
			`status`    =	'0'
			 WHERE `projects_sn` 		 = 	'".$projects_sn."' LIMIT 1 ");
			return 1;
		}else
		{
			$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
				`status`    =	'1'
			 	WHERE `projects_sn` 		 = 	'".$projects_sn."' LIMIT 1 ");
			return 1;
		}
	}

}
?>
