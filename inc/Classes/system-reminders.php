<?php if(!defined("inside")) exit;
class systemreminders
{
	var $tableName 	= "reminders";

	function getsitereminders_doc($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `reminders_type` = 'doc' GROUP BY `reminders_car_id` ORDER BY `reminders_sn` DESC ".$addon);
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				return($GLOBALS['db']->fetchlist());
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function getTotalreminders_doc($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `reminders_type` = 'doc' GROUP BY `reminders_car_id` ");
			$queryTotal 		= $GLOBALS['db']->fetchrow();
			$total 				= $queryTotal['total'];
			return ($total);
		}else{$GLOBALS['login']->doDestroy();return false;}
	}
    
    function getsitereminders_service($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `reminders_type` = 'service' GROUP BY `reminders_car_id` ORDER BY `reminders_sn` DESC ".$addon);
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				return($GLOBALS['db']->fetchlist());
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function getTotalreminders_service($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `reminders_type` = 'service' GROUP BY `reminders_car_id` ");
			$queryTotal 		= $GLOBALS['db']->fetchrow();
			$total 				= $queryTotal['total'];
			return ($total);
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

    function getusersInformation($mId)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `reminders_sn` = '".$mId."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitegroup = $GLOBALS['db']->fetchitem($query);
            return array(
                "reminders_sn"			            => 		$siteusers['reminders_sn'],
                "reminders_car_id"			        => 		$siteusers['reminders_car_id'],
                "reminders_type"			        => 		$siteusers['reminders_type'],
                "reminders_photo"			        => 		$siteusers['reminders_photo'],
                "reminders_type_id"			        => 		$siteusers['reminders_type_id'],
                "reminders_start_date"			    => 		$siteusers['reminders_start_date'],
                "reminders_repeat_number"		    => 		$siteusers['reminders_repeat_number'],
                "reminders_type_reminder"			=> 		$siteusers['reminders_type_reminder'],
                "reminders_next_date"			    => 		$siteusers['reminders_next_date'],
                "reminders_repeat_kilo"			    => 		$siteusers['reminders_repeat_kilo'],
                "reminders_remember_day"		    => 		$siteusers['reminders_remember_day'],
                "reminders_type_remember"	    	=> 		$siteusers['reminders_type_remember'],
                "reminders_remember_kilo"			=> 		$siteusers['reminders_remember_kilo'],
                "reminders_notification_date"	    => 		$siteusers['reminders_notification_date'],
                "reminders_status"			        => 		$siteusers['reminders_status']
            );
        }else{return null;}
	}
	function setremindersInformation($reminders)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
          `reminders_name`                   =          '".$reminders['reminders_name']."',
          `reminders_supply_id`              =          '".$reminders['reminders_supply_id']."',
          `reminders_accountable_id`         =          '".$reminders['reminders_accountable_id']."',
          `reminders_phone`                  =          '".$reminders['reminders_phone']."',
          `reminders_contract_start`         =          '".$reminders['reminders_contract_start']."',
          `reminders_contract_end`           =          '".$reminders['reminders_contract_end']."',
          `reminders_address`                =          '".$reminders['reminders_address']."',
          `reminders_city`                   =          '".$reminders['reminders_city']."',
          `reminders_email`                  =          '".$reminders['reminders_email']."'
          WHERE `reminders_sn`    	         = 	        '".$reminders['reminders_sn']."' LIMIT 1 ");
		return 1;
	}

	function add_New_reminders($reminders)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`reminders_sn`, `reminders_car_id`, `reminders_type`, `reminders_photo`, `reminders_type_id`, `reminders_start_date`, `reminders_repeat_number`, `reminders_type_reminder`, `reminders_next_date`, 
        `reminders_repeat_kilo`, `reminders_remember_day`, `reminders_type_remember`, `reminders_remember_kilo`, `reminders_notification_date`, `reminders_status`)
		VALUES ( NULL ,  '".$reminders['reminders_car_id']."',  '".$reminders['reminders_type']."' ,  '".$reminders['reminders_photo']."',  '".$reminders['reminders_type_id']."' ,  NOW(),  '".$reminders['reminders_repeat_number']."', 
        '".$reminders['reminders_type_reminder']."',  '".$reminders['reminders_next_date']."','".$reminders['reminders_repeat_kilo']."' ,'".$reminders['reminders_remember_day']."' ,'".$reminders['reminders_type_remember']."' ,
        '".$reminders['reminders_remember_kilo']."' ,'".$reminders['reminders_notification_date']."' , '0' )");
        
        $reminder_id = $GLOBALS['db']->fetchLastInsertId();
        foreach($reminders['reminders'] as $k => $v)
        {
            $GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `reminders_members`
            (`reminders_members_sn`, `reminders_members_reminder_id`, `reminders_members_user_id`)VALUES
            ( NULL ,'".$reminder_id."', '".$v."')");
        }
		return 1;
	}

}
?>
