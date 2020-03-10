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
            $siteprojects       = $GLOBALS['db']->fetchitem($query);
            $querytype          = $GLOBALS['db']->query("SELECT t.`transfer_type_name` , p.`project_car_types_car_number` FROM `project_car_types` p INNER JOIN `transfer_type` t ON p.`project_car_types_type_id` = t.`transfer_type_sn`  WHERE `project_car_types_project_id` = '".$siteprojects['projects_sn']."'");
            $querytypeTotal     = $GLOBALS['db']->resultcount();
            if($querytypeTotal > 0)
            {
                    $cartype = $GLOBALS['db']->fetchlist();
                    
                    foreach($cartype as $k => $v){
                        
                        $transfer_type_name  .= $v['transfer_type_name'];
                        if($k != ($querytypeTotal-1))
                        {
                            $transfer_type_name .= ' / ';
                        }
                        $car_number          += $v['project_car_types_car_number'];
                    }
            }
            $queryroad          = $GLOBALS['db']->query("SELECT COUNT(*) AS count FROM `project_roads`  WHERE `project_roads_project_id` = '".$siteprojects['projects_sn']."'");
            $siteroad       = $GLOBALS['db']->fetchitem($queryroad);
            return array(
                "projects_sn"			        => 		$siteprojects['projects_sn'],
                "projects_name"			        => 		$siteprojects['projects_name'],
                "projects_manger_id"			=> 		$siteprojects['projects_manger_id'],
                "projects_client"			    => 		$siteprojects['projects_client'],
                "projects_contract_start"       => 		$siteprojects['projects_contract_start'],
                "projects_contract_end"			=> 		$siteprojects['projects_contract_end'],
                "projects_client_phone"			=> 		$siteprojects['projects_client_phone'],
                "transfer_type_name"			=> 		$transfer_type_name,
                "project_car_types_car_number"  => 		$car_number,
                "roadcount"                     => 		$siteroad['count'],
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
		(`projects_sn`, `projects_name`, `projects_manger_id`, `projects_client`, `projects_contract_start`, `projects_contract_end`, `projects_client_phone`, `projects_status`) 
        VALUES ( NULL ,  '".$projects['projects_name']."' ,  '".$projects['projects_manger_id']."' , '".$projects['projects_client']."' , '".$projects['projects_contract_start']."' ,'".$projects['projects_contract_end']."' , '".$projects['projects_client_phone']."' ,   1 )");
		$project_id = $GLOBALS['db']->fetchLastInsertId();
        foreach($projects['project_car_types_car_number'] as $k => $v)
        {
            $GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `project_car_types` 
            (`project_car_types_sn`, `project_car_types_project_id`, `project_car_types_type_id`, `project_car_types_car_number`, `project_car_types_max_kilometer`, `project_car_types_status`)
            VALUES ( NULL ,'".$project_id."',  '".$projects['project_car_types_type_id'][$k]."', '".$v."','".$projects['project_car_types_max_kilometer'][$k]."', 1 )");
        }
        return 1;
	}
}
?>
