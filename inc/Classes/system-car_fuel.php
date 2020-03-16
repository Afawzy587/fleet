<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemcar_fuel
{
	var $tableName 	= "car_fuel";

	function getsitecar_fuel($addon = "",$from,$to)
	{
        $query = $GLOBALS['db']->query("
		SELECT Sum(`car_fuel_amount`) AS amount , SUM(`car_fuel_cost`) AS cost , SUM(`car_fuel_previous_read`) AS previous ,SUM(`car_fuel_now_read`) AS now ,`car_fuel_date` AS date FROM
		`".$this->tableName."` WHERE `car_fuel_date` between '".$from."' and '".$to."' GROUP BY `car_fuel_date` ORDER BY `car_fuel_date` DESC".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}
    
    function getsum($from,$to,$total)
	{
        $query = $GLOBALS['db']->query("
		SELECT  SUM(`".$total."`) AS total FROM
		`".$this->tableName."` WHERE `car_fuel_date` between '".$from."' and '".$to."' ");
        $sitecar_fuel = $GLOBALS['db']->fetchitem($query);
        return($sitecar_fuel['total']);
	}
    
    
    function searchcar_fuel($search)
	{
        $query = $GLOBALS['db']->query("
		SELECT Sum(d.`car_fuel_amount`) AS amount , SUM(d.`car_fuel_cost`) AS cost , SUM(d.`car_fuel_previous_read`) AS previous ,SUM(d.`car_fuel_now_read`) AS now ,d.`car_fuel_date` AS date FROM
		`".$this->tableName."`d INNER JOIN `cars` c ON d.`car_fuel_car_id` = c.`cars_sn` 
        WHERE 
        c.`cars_code` LIKE '%".$search."%' 
        OR c.`cars_plate_number` LIKE '%".$search."%' 
        OR c.`cars_chassis` LIKE '%".$search."%' 
        OR c.`cars_factory` LIKE '%".$search."%' 
        OR c.`cars_model` LIKE '%".$search."%' 
        OR c.`cars_year` LIKE '%".$search."%' 
        GROUP BY d.`car_fuel_date` ORDER BY d.`car_fuel_date` DESC");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotalcar_fuel($from,$to)
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `car_fuel_date` between '".$from."' and '".$to."' GROUP BY `car_fuel_date` ORDER BY `car_fuel_date` DESC");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getcar_fuelInformation($car_fuel_sn)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `car_fuel_sn` = '".$car_fuel_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitecar_fuel = $GLOBALS['db']->fetchitem($query);
            return array(
                "car_fuel_sn"			            => 		$sitecar_fuel['car_fuel_sn'],
                "car_fuel_car_id"			        => 		$sitecar_fuel['car_fuel_car_id'],
                "car_fuel_by"			            => 		$sitecar_fuel['car_fuel_by'],
                "car_fuel_previous_read"			=> 		$sitecar_fuel['car_fuel_previous_read'],
                "car_fuel_now_read"			        => 		$sitecar_fuel['car_fuel_now_read'],
                "car_fuel_date"			            => 		$sitecar_fuel['car_fuel_date'],
                "car_fuel_time"			            => 		$sitecar_fuel['car_fuel_time'],
                "car_fuel_fuel_id"			        => 		$sitecar_fuel['car_fuel_fuel_id'],
                "car_fuel_station"			        => 		$sitecar_fuel['car_fuel_station'],
                "car_fuel_amount"			        => 		$sitecar_fuel['car_fuel_amount'],
                "car_fuel_counter_photo"			=> 		$sitecar_fuel['car_fuel_counter_photo'],
                "car_fuel_pump_photo"		        => 		$sitecar_fuel['car_fuel_pump_photo'],
                "car_fuel_invoice_photo"			=> 		$sitecar_fuel['car_fuel_invoice_photo'],
                "car_fuel_status"			        => 		$sitecar_fuel['car_fuel_status'],
            );
        }else{return null;}
	}
	

	function setcar_fuelInformation($car_fuel)
	{
        if($car_fuel['car_fuel_pump_photo'] != "")
		{
			$car_fuel_pump_photo = "`car_fuel_pump_photo`='".$car_fuel['car_fuel_pump_photo']."',";
		}else
		{
			$car_fuel_pump_photo = "";
		}
        
        if($car_fuel['car_fuel_counter_photo'] != "")
		{
			$car_fuel_counter_photo = "`car_fuel_counter_photo`='".$car_fuel['car_fuel_counter_photo']."',";
		}else
		{
			$car_fuel_counter_photo = "";
		}
        
        if($car_fuel['car_fuel_invoice_photo'] != "")
		{
			$car_fuel_invoice_photo = "`car_fuel_invoice_photo`='".$car_fuel['car_fuel_invoice_photo']."',";
		}else
		{
			$car_fuel_invoice_photo = "";
		}
		
		
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `car_fuel_by`			        = 		'".$car_fuel['car_fuel_by']."',".$car_fuel_pump_photo."
            `car_fuel_car_id`			    = 		'".$car_fuel['car_fuel_car_id']."',".$car_fuel_counter_photo."
            `car_fuel_previous_read`		= 		'".$car_fuel['car_fuel_previous_read']."',".$car_fuel_invoice_photo."
            `car_fuel_date`			        = 		'".$car_fuel['car_fuel_date']."',
            `car_fuel_time`			        = 		'".$car_fuel['car_fuel_time']."',
            `car_fuel_now_read`			    = 		'".$car_fuel['car_fuel_now_read']."',
            `car_fuel_fuel_id`			    = 		'".$car_fuel['car_fuel_fuel_id']."',
            `car_fuel_station`			    = 		'".$car_fuel['car_fuel_station']."',
            `car_fuel_amount`			    = 		'".$car_fuel['car_fuel_amount']."',
            `car_fuel_cost`			        = 		'".$car_fuel['car_fuel_cost']."'
          WHERE `car_fuel_sn`    	        = 	    '".$car_fuel['car_fuel_sn']."' LIMIT 1 ");
		return 1;
	}
	function addNewcar_fuel($car_fuel)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`car_fuel_sn`, `car_fuel_car_id`, `car_fuel_by`, `car_fuel_previous_read`, `car_fuel_now_read`, `car_fuel_date`,
        `car_fuel_time`, `car_fuel_fuel_id`, `car_fuel_station`, `car_fuel_amount`, `car_fuel_cost`, `car_fuel_counter_photo`,
        `car_fuel_pump_photo`, `car_fuel_invoice_photo`, `car_fuel_status`)
		VALUES ( NULL ,  '".$car_fuel['car_fuel_car_id']."' ,  '".$car_fuel['car_fuel_by']."',  '".$car_fuel['car_fuel_previous_read']."' ,  '".$car_fuel['car_fuel_now_read']."',  '".$car_fuel['car_fuel_date']."' , 
        '".$car_fuel['car_fuel_time']."','".$car_fuel['car_fuel_fuel_id']."' ,  '".$car_fuel['car_fuel_station']."',  '".$car_fuel['car_fuel_amount']."' ,  '".$car_fuel['car_fuel_cost']."',  '".$car_fuel['car_fuel_counter_photo']."' , 
        '".$car_fuel['car_fuel_pump_photo']."','".$car_fuel['car_fuel_invoice_photo']."' , 1 )");
		return 1;
	}
}
?>
