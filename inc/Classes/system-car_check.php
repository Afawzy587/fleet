<?php if(!defined("inside")) exit;
class systemcar_check
{
	var $tableName 	= "car_check";

	function getsitecar_check($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` ORDER BY `car_check_sn` DESC ".$addon);
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				return($GLOBALS['db']->fetchlist());
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function getTotalcar_check($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` ");
			$queryTotal 		= $GLOBALS['db']->fetchrow();
			$total 				= $queryTotal['total'];
			return ($total);
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function getcar_checkInformation($car_check_sn)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
            $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` h INNER JOIN `cars` c ON h.`car_check_car_id` = c.`cars_sn` WHERE h.`car_check_sn` = '".$car_check_sn."' LIMIT 1 ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				$sitecar_check = $GLOBALS['db']->fetchitem($query);
                $query     = $GLOBALS['db']->query("SELECT * FROM `check_items` WHERE `check_items_check_id` = '".$sitecar_check['car_check_sn']."' ");   
                $itemTotal = $GLOBALS['db']->resultcount();
                if($itemTotal > 0)
                {
                    $item = $GLOBALS['db']->fetchlist();
                }
				return array(
					"car_check_sn"			            => 		$sitecar_check['car_check_sn'],
					"car_check_car_id"			        => 		$sitecar_check['car_check_car_id'],
					"cars_code"			                => 		$sitecar_check['cars_code'],
					"cars_model"			            => 		$sitecar_check['cars_model'],
					"cars_year"			                => 		$sitecar_check['cars_year'],
					"cars_plate_number"		         	=> 		$sitecar_check['cars_plate_number'],
					"cars_supervisor_id"		        => 		$sitecar_check['cars_supervisor_id'],
					"cars_project_id"		         	=> 		$sitecar_check['cars_project_id'],
					"cars_photo"		         	    => 		$sitecar_check['cars_photo'],
					"cars_car_status"		         	=> 		$sitecar_check['cars_car_status'],
					"car_check_by"			            => 		$sitecar_check['car_check_by'],
					"car_check_date"			        => 		$sitecar_check['car_check_date'],
					"car_check_tank"			        => 		$sitecar_check['car_check_tank'],
					"car_check_kilos"			        => 		$sitecar_check['car_check_kilos'],
					"car_check_photo"			        => 		$sitecar_check['car_check_photo'],
					"car_check_phot_1"			        => 		$sitecar_check['car_check_photo_1'],
					"car_check_phot_2"			        => 		$sitecar_check['car_check_photo_2'],
					"check_item"			            => 		$item,
					"car_check_status"			        => 		$sitecar_check['car_check_status'],
				);
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}
	
	function iscar_checkExists($name)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `group_name` = '".$name."' LIMIT 1 ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal == 1)
			{
				$sitecar_check = $GLOBALS['db']->fetchitem($query);
				return array(
					"car_check_sn"			            => 		$sitecar_check['car_check_sn']
				);
			}else{return true;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function setcar_checkInformation($car_check)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
          `car_check_name`                   =          '".$car_check['car_check_name']."',
          `car_check_supply_id`              =          '".$car_check['car_check_supply_id']."',
          `car_check_accountable_id`         =          '".$car_check['car_check_accountable_id']."',
          `car_check_phone`                  =          '".$car_check['car_check_phone']."',
          `car_check_contract_start`         =          '".$car_check['car_check_contract_start']."',
          `car_check_contract_end`           =          '".$car_check['car_check_contract_end']."',
          `car_check_address`                =          '".$car_check['car_check_address']."',
          `car_check_city`                   =          '".$car_check['car_check_city']."',
          `car_check_email`                  =          '".$car_check['car_check_email']."'
          WHERE `car_check_sn`    	         = 	        '".$car_check['car_check_sn']."' LIMIT 1 ");
		return 1;
	}

	function addNewcar_check($car_check)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`car_check_sn`, `car_check_name`, `car_check_supply_id`, `car_check_accountable_id`, `car_check_phone`, `car_check_contract_start`, `car_check_contract_end`, `car_check_address`, `car_check_city`, `car_check_email`, `car_check_status`)
		VALUES ( NULL ,  '".$car_check['car_check_name']."',  '".$car_check['car_check_supply_id']."' ,  '".$car_check['car_check_accountable_id']."',  '".$car_check['car_check_phone']."' ,  '".$car_check['car_check_contract_start']."',  '".$car_check['car_check_contract_end']."' ,  '".$car_check['car_check_address']."',  '".$car_check['car_check_city']."' ,  '".$car_check['car_check_email']."',  '1')");
		return 1;
	}


}
?>
