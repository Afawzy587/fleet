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
    function searchreminders_doc($search)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT d.* FROM `".$this->tableName."` d INNER JOIN `cars` c ON d.`reminders_car_id` = c.`cars_sn` 
            WHERE  d.`reminders_type` = 'doc' AND
            (c.`cars_code` LIKE '%".$search."%' 
            OR c.`cars_plate_number` LIKE '%".$search."%' 
            OR c.`cars_chassis` LIKE '%".$search."%' 
            OR c.`cars_factory` LIKE '%".$search."%' 
            OR c.`cars_model` LIKE '%".$search."%' 
            OR c.`cars_year` LIKE '%".$search."%' )
             GROUP BY d.`reminders_car_id` ORDER BY d.`reminders_sn` DESC ");
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
    
    function searchreminders_service($search)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT d.* FROM `".$this->tableName."` d INNER JOIN `cars` c ON d.`reminders_car_id` = c.`cars_sn` 
            WHERE  d.`reminders_type` = 'service' AND
            (c.`cars_code` LIKE '%".$search."%' 
            OR c.`cars_plate_number` LIKE '%".$search."%' 
            OR c.`cars_chassis` LIKE '%".$search."%' 
            OR c.`cars_factory` LIKE '%".$search."%' 
            OR c.`cars_model` LIKE '%".$search."%' 
            OR c.`cars_year` LIKE '%".$search."%' )
             GROUP BY d.`reminders_car_id` ORDER BY d.`reminders_sn` DESC ");
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

    function getremindersInformation($mId)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `reminders_car_id` = '".$mId."' ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitereminder = $GLOBALS['db']->fetchlist($query);
            return array(
                "reminders_car_id"			        => 		$mId,
                "reminders"			                => 		$sitereminder
            );
        }else{return null;}
	}
    
    
    function get_remind_details($mId)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `reminders_sn` = '".$mId."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitereminder = $GLOBALS['db']->fetchitem($query);
            return array(
                "reminders_sn"			            => 		$sitereminder['reminders_sn'],
                "reminders_car_id"			        => 		$sitereminder['reminders_car_id'],
                "reminders_type"			        => 		$sitereminder['reminders_type'],
                "reminders_photo"			        => 		$sitereminder['reminders_photo'],
                "reminders_type_id"			        => 		$sitereminder['reminders_type_id'],
                "reminders_start_date"			    => 		$sitereminder['reminders_start_date'],
                "reminders_repeat_number"		    => 		$sitereminder['reminders_repeat_number'],
                "reminders_type_reminder"			=> 		$sitereminder['reminders_type_reminder'],
                "reminders_next_date"			    => 		$sitereminder['reminders_next_date'],
                "reminders_repeat_kilo"			    => 		$sitereminder['reminders_repeat_kilo'],
                "reminders_remember_day"		    => 		$sitereminder['reminders_remember_day'],
                "reminders_type_remember"	    	=> 		$sitereminder['reminders_type_remember'],
                "reminders_remember_kilo"			=> 		$sitereminder['reminders_remember_kilo'],
                "reminders_notification_date"	    => 		$sitereminder['reminders_notification_date'],
                "reminders_status"			        => 		$sitereminder['reminders_status']
            );
        }else{return null;}
	}
	function setremindersInformation($reminders)
	{
        
        if($reminders['reminders_type_reminder'] == 1 )
        {
           $reminders['reminders_next_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_repeat_number'].'days',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_reminder'] == 2 )
        {
            $reminders['reminders_next_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_repeat_number'].'month',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_reminder'] == 3 )
        {
            $reminders['reminders_next_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_repeat_number'].'year',strtotime(date('Y-m-d'))));
        }
        
        if($reminders['reminders_type_remember'] == 1 )
        {
           $reminders['reminders_notification_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_remember_day'].'days',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_remember'] == 2 )
        {
            $reminders['reminders_notification_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_remember_day'].'month',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_remember'] == 3 )
        {
            $reminders['reminders_notification_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_remember_day'].'year',strtotime(date('Y-m-d'))));
        }
        
        if($reminders['reminders_photo'] != "")
		{
			$reminders_photo = "`reminders_photo`='".$reminders['reminders_photo']."',";
		}else
		{
			$reminders_photo = "";
		}
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
          `reminders_type_id`               =          '".$reminders['reminders_type_id']."',".$reminders_photo."
          `reminders_repeat_number`         =          '".$reminders['reminders_repeat_number']."',
          `reminders_type_reminder`         =          '".$reminders['reminders_type_reminder']."',
          `reminders_repeat_kilo`           =          '".$reminders['reminders_repeat_kilo']."',
          `reminders_type_remember`         =          '".$reminders['reminders_type_remember']."',
          `reminders_remember_day`          =          '".$reminders['reminders_remember_day']."',
          `reminders_remember_kilo`         =          '".$reminders['reminders_remember_kilo']."'
          WHERE `reminders_sn`    	        = 	       '".$reminders['reminders_sn']."' LIMIT 1 ");
        $GLOBALS['db']->query("DELETE LOW_PRIORITY FROM `reminders_members` WHERE `reminders_members_reminder_id` = '".$reminders['reminders_sn']."'");
        
        foreach($reminders['reminders'] as $k => $v)
        {
            $GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `reminders_members`
            (`reminders_members_sn`, `reminders_members_reminder_id`, `reminders_members_user_id`)VALUES
            ( NULL ,'".$reminders['reminders_sn']."', '".$v."')");
        }
		return 1;
	}

	function add_New_reminders($reminders)
	{
        if($reminders['reminders_type_reminder'] == 1 )
        {
           $reminders['reminders_next_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_repeat_number'].'days',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_reminder'] == 2 )
        {
            $reminders['reminders_next_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_repeat_number'].'month',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_reminder'] == 3 )
        {
            $reminders['reminders_next_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_repeat_number'].'year',strtotime(date('Y-m-d'))));
        }
        
        if($reminders['reminders_type_remember'] == 1 )
        {
           $reminders['reminders_notification_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_remember_day'].'days',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_remember'] == 2 )
        {
            $reminders['reminders_notification_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_remember_day'].'month',strtotime(date('Y-m-d'))));
        }elseif($reminders['reminders_type_remember'] == 3 )
        {
            $reminders['reminders_notification_date']  = date('Y-m-d',strtotime('+'.$reminders['reminders_remember_day'].'year',strtotime(date('Y-m-d'))));
        }
        
            
            
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
