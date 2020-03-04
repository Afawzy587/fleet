<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemcars
{
	var $tableName 	= "cars";

	function getsitecars($addon = "")
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `cars_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}
	function getselectcars()
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `cars_sn`  DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotalcars($addon = "")
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `cars_sn` !='".$_SESSION['id']."'");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getcarsInformation($cars_sn)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `cars_sn` = '".$cars_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitecars = $GLOBALS['db']->fetchitem($query);
            $query = $GLOBALS['db']->query("SELECT * FROM `car_docments` WHERE `car_docments_car_id` = '".$cars_sn."' ");   
            $queryTotal = $GLOBALS['db']->resultcount();
            if($queryTotal > 0)
            {
                $doc = $GLOBALS['db']->fetchlist();
            }
        
            return array(
                    "cars_sn"                       =>       $sitecars['cars_sn'],
                    "cars_photo"                    =>       $sitecars['cars_photo'],
                    "cars_code"                     =>       $sitecars['cars_code'],
                    "cars_plate_number"             =>       $sitecars['cars_plate_number'],
                    "cars_chassis"                  =>       $sitecars['cars_chassis'],
                    "cars_engine"                   =>       $sitecars['cars_engine'],
                    "cars_factory"                  =>       $sitecars['cars_factory'],
                    "cars_model"                    =>       $sitecars['cars_model'],
                    "cars_year"                     =>       $sitecars['cars_year'],
                    "cars_kilometer"                =>       $sitecars['cars_kilometer'],
                    "cars_car_type"                 =>       $sitecars['cars_car_type'],
                    "cars_owner_type_id"            =>       $sitecars['cars_owner_type_id'],
                    "cars_supervisor_id"            =>       $sitecars['cars_supervisor_id'],
                    "cars_project_id"               =>       $sitecars['cars_project_id'],
                    "cars_car_status"               =>       $sitecars['cars_car_status'],
                    "cars_kilo_litre"               =>       $sitecars['cars_kilo_litre'],
                    "cars_department_id"            =>       $sitecars['cars_department_id'],
                    "cars_long"                     =>       $sitecars['cars_long'],
                    "cars_height"                   =>       $sitecars['cars_height'],
                    "cars_height_ground"            =>       $sitecars['cars_height_ground'],
                    "cars_width"                    =>       $sitecars['cars_width'],
                    "cars_peoples"                  =>       $sitecars['cars_peoples'],
                    "cars_weight"                   =>       $sitecars['cars_weight'],
                    "cars_max_weight"               =>       $sitecars['cars_max_weight'],
                    "cars_controller"               =>       $sitecars['cars_controller'],
                    "cars_fuel_type"                =>       $sitecars['cars_fuel_type'],
                    "cars_tank_capacity"            =>       $sitecars['cars_tank_capacity'],
                    "cars_oil_capacity"             =>       $sitecars['cars_oil_capacity'],
                    "cars_oil_change"               =>       $sitecars['cars_oil_change'],
                    "cars_tire_type_first"          =>       $sitecars['cars_tire_type_first'],
                    "cars_tire_type_second"         =>       $sitecars['cars_tire_type_second'],
                    "cars_number_first"             =>       $sitecars['cars_number_first'],
                    "cars_number_second"            =>       $sitecars['cars_number_second'],
                    "cars_change_first"             =>       $sitecars['cars_change_first'],
                    "cars_change_second"            =>       $sitecars['cars_change_second'],
                    "cars_price"                    =>       $sitecars['cars_price'],
                    "cars_year_damage"              =>       $sitecars['cars_year_damage'],
                    "cars_damage_price"             =>       $sitecars['cars_damage_price'],
                    "cars_maintenance_budget"       =>       $sitecars['cars_maintenance_budget'],
                    "cars_annual_interest"          =>       $sitecars['cars_annual_interest'],
                    "cars_gps_fees"                 =>       $sitecars['cars_gps_fees'],
                    "cars_maintenance_expectation"  =>       $sitecars['cars_maintenance_expectation'],
                    "cars_expenses"                 =>       $sitecars['cars_expenses'],
                    "max_kilo"                      =>       $sitecars['max_kilo'],
                    "cars_driver_salary"            =>       $sitecars['cars_driver_salary'],
                    "cars_kilo_litre"               =>       $sitecars['cars_kilo_litre'],
                    "cars_docs"                     =>       $doc,
                    "cars_status"                   =>       $sitecars['cars_status']
            );
        }else{return null;}
	}
	
	function iscarsExists($name)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `cars_name` = '".$name."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $sitecars = $GLOBALS['db']->fetchitem($query);
            return array(
                "cars_sn"			            => 		$sitecars['cars_sn']
            );


        }else{return true;}
	}

	function setcarsInformation($cars)
	{
        if($cars['cars_photo'] != "")
		{
			$cars_photo = "`cars_photo`='".$cars['cars_photo']."',";
		}else
		{
			$cars_photo = "";
		}
		
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `cars_name`			        = 		'".$cars['cars_name']."',".$cars_password."
            `cars_managment_id`			= 		'".$cars['cars_managment_id']."',".$cars_contract_photo."
            `cars_job_id`			        = 		'".$cars['cars_job_id']."',".$cars_personal_id."
            `cars_qualification`			= 		'".$cars['cars_qualification']."',".$cars_photo."
            `cars_birthday`			    = 		'".$cars['cars_birthday']."',
            `cars_hiring_date`			    = 		'".$cars['cars_hiring_date']."',
            `cars_phone`			        = 		'".$cars['cars_phone']."',
            `cars_email`			        = 		'".$cars['cars_email']."',
            `cars_net_salary`			    = 		'".$cars['cars_job_serial']."',
            `cars_email`			        = 		'".$cars['cars_net_salary']."',
            `cars_salary_exchanges`		= 		'".$cars['cars_salary_exchanges']."',
            `cars_license_id`			    = 		'".$cars['cars_license_id']."',
            `cars_license_place`			= 		'".$cars['cars_license_place']."',
            `cars_license_expired`			= 		'".$cars['cars_license_expired']."',
            `cars_contract_finish`			= 		'".$cars['cars_contract_finish']."',
            `cars_notes`			        = 		'".$cars['cars_notes']."',
            `cars_username`			    = 		'".$cars['cars_username']."',
            `cars_group_id`			    = 		'".$cars['cars_group_id']."'
          WHERE `cars_sn`    	            = 	    '".$cars['cars_sn']."' LIMIT 1 ");
		return 1;
	}

	function addNewcars($cars)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`cars_sn`, `cars_code`, `cars_plate_number`, `cars_chassis`, `cars_engine`, `cars_factory`,
        `cars_model`, `cars_year`, `cars_kilometer`, `cars_car_type`, `cars_owner_type_id`, `cars_supervisor_id`, 
        `cars_project_id`, `cars_car_status`, `cars_photo`, `cars_department_id`, `cars_long`, `cars_height`, `cars_peoples`,
        `cars_weight`, `cars_max_weight`, `cars_controller`, `cars_fuel_type`, `cars_tank_capacity`, `cars_oil_capacity`,
        `cars_oil_change`, `cars_tire_type_first`, `cars_number_first`, `cars_change_first`, `cars_tire_type_second`, `cars_number_second`,
        `cars_change_second`, `cars_price`, `cars_year_damage`, `cars_damage_price`, `cars_maintenance_budget`, `cars_annual_interest`,
        `cars_gps_fees`, `cars_maintenance_expectation`, `cars_expenses`, `cars_kilo_litre`, `max_kilo`, `cars_driver_salary`, `cars_status`)
        VALUES
        (NULL, '".$cars['cars_code']."', '".$cars['cars_plate_number']."', '".$cars['cars_chassis']."', '".$cars['cars_engine']."', '".$cars['cars_factory']."',
        '".$cars['cars_model']."', '".$cars['cars_year']."', '".$cars['cars_kilometer']."', '".$cars['cars_car_type']."', '".$cars['cars_owner_type_id']."', '".$cars['cars_supervisor_id']."', 
        '".$cars['cars_project_id']."', '".$cars['cars_car_status']."', '".$cars['cars_photo']."', '".$cars['cars_department_id']."', '".$cars['cars_long']."', '".$cars['cars_height']."', '".$cars['cars_peoples']."', 
        '".$cars['cars_weight']."', '".$cars['cars_max_weight']."', '".$cars['cars_controller']."', '".$cars['cars_fuel_type']."', '".$cars['cars_tank_capacity']."', '".$cars['cars_oil_capacity']."',
        '".$cars['cars_oil_change']."', '".$cars['cars_tire_type_first']."', '".$cars['cars_number_first']."', '".$cars['cars_change_first']."', '".$cars['cars_tire_type_second']."', '".$cars['cars_number_second']."',
        '".$cars['cars_change_second']."', '".$cars['cars_price']."', '".$cars['cars_year_damage']."', '".$cars['cars_damage_price']."', '".$cars['cars_maintenance_budget']."', '".$cars['cars_annual_interest']."', 
        '".$cars['cars_gps_fees']."', '".$cars['cars_maintenance_expectation']."', '".$cars['cars_expenses']."', '".$cars['cars_kilo_litre']."', '".$cars['max_kilo']."', '".$cars['cars_driver_salary']."', 1)");
		
        $car_id = $GLOBALS['db']->fetchLastInsertId();
        
        
        foreach($cars['car_docments_name'] as $k => $v)
        {
            $GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `car_docments`
            (`car_docments_sn`, `car_docments_name`, `car_docments_date_start`, `car_docments_date_end`, `car_docments_car_id`, `car_docments_photo`, `car_docments_value`, `car_docments_status`) 
            VALUES ( NULL ,'".$v."',  '".$cars['car_docments_date_start'][$k]."', '".$cars['car_docments_date_end'][$k]."','".$car_id."','".$cars['cars_docs_file'][$k]."','".$cars['car_docments_value'][$k]."', 1 )");
        }
        return 1;
	}
    
    
    function add_car_order($order)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `car_orders`(`car_orders_sn`, `car_orders_car_id`, `car_orders_supervisor_id`, `car_orders_driver_id`, `car_orders_project_id`, `car_orders_road_id`, `car_orders_delivery_by`, `car_orders_delivery_kilos`, `car_orders_delivery_date`, `car_orders_delivery_time`, `car_orders_expect_kilos`, `car_orders_expect_date`, `car_orders_expect_time`, `car_orders_check_id`, `car_orders_status`) 
        VALUES (NULL,'".$order['car_orders_car_id']."','".$order['car_orders_supervisor_id']."','".$order['car_orders_driver_id']."','".$order['car_orders_project_id']."','".$order['car_orders_road_id']."','".$order['car_orders_delivery_by']."','".$order['car_orders_delivery_kilos']."','".$order['car_orders_delivery_date']."','".$order['car_orders_delivery_time']."','".$order['car_orders_expect_kilos']."','".$order['car_orders_expect_date']."','".$order['car_orders_expect_time']."','".$order['car_orders_check_id']."',1)");
        return 1;
	}    
    function add_car_back($back)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `back_car`
        (`back_car_sn`, `back_car_id`, `back_car_supervisor_id`, `back_car_driver_id`, `back_car_delivery_by`, `back_car_kilos`, `back_car_date`, `back_car_time`, `back_car_check_id`, `back_car_status`)
        VALUES (NULL,'".$back['back_car_id']."','".$back['back_car_supervisor_id']."','".$back['back_car_driver_id']."','".$back['back_car_delivery_by']."','".$back['back_car_kilos']."','".$back['back_car_date']."','".$back['back_car_time']."','".$back['back_car_check_id']."',1)");
        return 1;
	}


}
?>
