<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemjob_orders
{
	var $tableName 	= "job_orders";

	function getsitejob_ordersIntime($addon = "",$from,$to)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE  `job_orders_date_in` between  '".$from."' and '".$to."' ORDER BY `job_orders_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}
    function getservicesum($from,$to)
	{
        $query = $GLOBALS['db']->query("SELECT SUM(`job_orders_total_fix`) AS total_fix , SUM(`job_orders_total_price`) AS total_price , SUM(`job_orders_extra`) AS extra , SUM(`job_orders_discount`) AS discount FROM `".$this->tableName."` WHERE  `job_orders_date_in` between  '".$from."' and '".$to."'");
        $sitejob = $GLOBALS['db']->fetchitem($query);
        return(($sitejob['total_fix'] + $sitejob['total_price'] + $sitejob['extra'] - $sitejob['discount']));
	}
    
    function getsitejob_orderssearch($search)
	{
        $query = $GLOBALS['db']->query("SELECT d.* FROM `".$this->tableName."` d INNER JOIN `cars` c ON d.`job_orders_car_id` = c.`cars_sn` 
            WHERE 
            d.`job_orders_sn` = '".$search."' 
            OR c.`cars_code` LIKE '%".$search."%' 
            OR c.`cars_plate_number` LIKE '%".$search."%' 
            OR c.`cars_chassis` LIKE '%".$search."%' 
            OR c.`cars_factory` LIKE '%".$search."%' 
            OR c.`cars_model` LIKE '%".$search."%' 
            OR c.`cars_year` LIKE '%".$search."%' 
        ORDER BY d.`job_orders_sn`  DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotaljob_ordersintime($from, $to)
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `job_orders_date_in` between '".$from."' and '".$to."' ");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getjob_ordersInformation($job_orders_sn)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `job_orders_sn` = '".$job_orders_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitejob_orders       = $GLOBALS['db']->fetchitem($query);
            $querytype          = $GLOBALS['db']->query("SELECT t.`transfer_type_name` , p.`project_car_types_car_number` FROM `project_car_types` p INNER JOIN `transfer_type` t ON p.`project_car_types_type_id` = t.`transfer_type_sn`  WHERE `project_car_types_project_id` = '".$sitejob_orders['job_orders_sn']."'");
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
            $queryroad          = $GLOBALS['db']->query("SELECT COUNT(*) AS count FROM `project_roads`  WHERE `project_roads_project_id` = '".$sitejob_orders['job_orders_sn']."'");
            $siteroad       = $GLOBALS['db']->fetchitem($queryroad);
            return array(
                "job_orders_sn"			        => 		$sitejob_orders['job_orders_sn'],
                "job_orders_name"			        => 		$sitejob_orders['job_orders_name'],
                "job_orders_manger_id"			=> 		$sitejob_orders['job_orders_manger_id'],
                "job_orders_client"			    => 		$sitejob_orders['job_orders_client'],
                "job_orders_contract_start"       => 		$sitejob_orders['job_orders_contract_start'],
                "job_orders_contract_end"			=> 		$sitejob_orders['job_orders_contract_end'],
                "job_orders_client_phone"			=> 		$sitejob_orders['job_orders_client_phone'],
                "transfer_type_name"			=> 		$transfer_type_name,
                "project_car_types_car_number"  => 		$car_number,
                "roadcount"                     => 		$siteroad['count'],
                );
                
        }else{return null;}
	}
	
	function isjob_ordersExists($name)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `job_orders_name` = '".$name."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $sitejob_orders = $GLOBALS['db']->fetchitem($query);
            return array(
                "job_orders_sn"			            => 		$sitejob_orders['job_orders_sn']
            );
        }else{return true;}
	}

	function setjob_ordersInformation($job_orders)
	{
        
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `job_orders_name`			        = 		'".$job_orders['job_orders_name']."',".$job_orders_password."
            `job_orders_managment_id`			= 		'".$job_orders['job_orders_managment_id']."',".$job_orders_contract_photo."
            `job_orders_job_id`			        = 		'".$job_orders['job_orders_job_id']."',".$job_orders_personal_id."
            `job_orders_qualification`			= 		'".$job_orders['job_orders_qualification']."',".$job_orders_photo."
            `job_orders_birthday`			    = 		'".$job_orders['job_orders_birthday']."',
            `job_orders_hiring_date`			    = 		'".$job_orders['job_orders_hiring_date']."',
            `job_orders_phone`			        = 		'".$job_orders['job_orders_phone']."',
            `job_orders_email`			        = 		'".$job_orders['job_orders_email']."',
            `job_orders_net_salary`			    = 		'".$job_orders['job_orders_job_serial']."',
            `job_orders_email`			        = 		'".$job_orders['job_orders_net_salary']."',
            `job_orders_salary_exchanges`		= 		'".$job_orders['job_orders_salary_exchanges']."',
            `job_orders_license_id`			    = 		'".$job_orders['job_orders_license_id']."',
            `job_orders_license_place`			= 		'".$job_orders['job_orders_license_place']."',
            `job_orders_license_expired`			= 		'".$job_orders['job_orders_license_expired']."',
            `job_orders_contract_finish`			= 		'".$job_orders['job_orders_contract_finish']."',
            `job_orders_notes`			        = 		'".$job_orders['job_orders_notes']."',
            `job_orders_username`			    = 		'".$job_orders['job_orders_username']."',
            `job_orders_group_id`			    = 		'".$job_orders['job_orders_group_id']."'
          WHERE `job_orders_sn`    	            = 	    '".$job_orders['job_orders_sn']."' LIMIT 1 ");
		return 1;
	}

	function addNewjob_orders($job_orders)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`job_orders_sn`, `job_orders_name`, `job_orders_manger_id`, `job_orders_client`, `job_orders_contract_start`, `job_orders_contract_end`, `job_orders_client_phone`, `job_orders_status`) 
        VALUES ( NULL ,  '".$job_orders['job_orders_name']."' ,  '".$job_orders['job_orders_manger_id']."' , '".$job_orders['job_orders_client']."' , '".$job_orders['job_orders_contract_start']."' ,'".$job_orders['job_orders_contract_end']."' , '".$job_orders['job_orders_client_phone']."' ,   1 )");
		$project_id = $GLOBALS['db']->fetchLastInsertId();
        foreach($job_orders['project_car_types_car_number'] as $k => $v)
        {
            $GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `project_car_types` 
            (`project_car_types_sn`, `project_car_types_project_id`, `project_car_types_type_id`, `project_car_types_car_number`, `project_car_types_max_kilometer`, `project_car_types_status`)
            VALUES ( NULL ,'".$project_id."',  '".$job_orders['project_car_types_type_id'][$k]."', '".$v."','".$job_orders['project_car_types_max_kilometer'][$k]."', 1 )");
        }
        return 1;
	}
}
?>
