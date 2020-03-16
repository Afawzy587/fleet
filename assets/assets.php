<?php
 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	######### Main Security Basic Filter Function ;) #########
	function sanitize( $str , $type = "str" )
	{
		$str = strip_tags ($str);
		$str = trim ($str);
		$str = htmlspecialchars ($str, ENT_NOQUOTES);
		$str = addslashes ($str);
		if($type == "area")
		$str = str_replace("\n","<br />",$str);
		return $str;
	}

	function difftime($date)
	{
		 $date1  = strtotime($date);
		 $date2  = strtotime(date("Y-m-d H:i:s")) + 7200;
		// Formulate the Difference between two dates

	    $diff = abs($date2 - $date1);
		// To get the year divide the resultant date into
		// total seconds in a year (365*60*60*24)
		$years = floor($diff / (365*60*60*24));

		// To get the month, subtract it with years and
		// divide the resultant date into
		// total seconds in a month (30*60*60*24)
	    $months = floor(($diff - $years * 365*60*60*24)/ (30*60*60*24));
		// To get the day, subtract it with years and
		// months and divide the resultant date into
		// total seconds in a days (60*60*24)
		$days = floor(($diff - (($years * 365*60*60*24) - ($months*30*60*60*24)))/ (60*60*24));
		// To get the hour, subtract it with years,
		// months & seconds and divide the resultant
		// date into total seconds in a hours (60*60)
		$hours = floor(($diff - (($years * 365*60*60*24) - (($months*30*60*60*24) - ($days*60*60*24)))) / (60*60));
		// To get the minutes, subtract it with years,
		// months, seconds and hours and divide the
		// resultant date into total seconds i.e. 60
		$minutes = floor(($diff - $years * 365*60*60*24
				 - $months*30*60*60*24 - $days*60*60*24
								  - $hours*60*60)/ 60);
		// To get the minutes, subtract it with years,
		// months, seconds, hours and minutes
		$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minutes*60));
		// Print the result



		if($years   > 0 ){$y    = $years. " سنة " ; }
		if($months  > 0 ){$m    = $months. " شهر " ;}
		if($days    > 0 ){$d    = $days. " يوم " ;}
//		if($hours   > 0 ){$h    = $hours." ساعة ";}
//		if($minutes > 0 ){$i    = $minutes . " دقيقة " ;}
//		if($seconds > 0 ){$s    = $seconds . " ثانية ";}

		if($date2 > $date1){
			$when = $GLOBALS['lang']['since'];
		}else{
			$when = $GLOBALS['lang']['after'];
		}
		echo $when."<span title='.$date.'>" .$y.$m.$d."</span>";
	}
    ######### Swapping textarea Content #########
    function br2nl($str)
	{
	    $str = str_replace("<br />","\n",$str);
	    return $str;
	}
	######### Valid Email Check #########
	function checkMail($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? false : true;
	}
    ////////// Valid phone check ///////////////
    function checkPhone($phone)
    {
        $phone  = str_replace("+2","",$phone);
        if(strlen($phone) == 11 || !is_numeric($phone))
        {
            $sub = substr($phone,0,3);
            $ext = ['010','011','012','015'];
            return ( ! in_array($sub,$ext) ? false : true);
        }elseif(strlen($phone) == 10 || !is_numeric($phone)){
            $pattern = "/^0[1-9]{1}[0-9]{8}$/";
            return ( !preg_match($pattern, $number) ? false : true);
        }else{
            return false;
        }
        
        
    }

    ///############# Send notification ##################//
    function send_notification($message, $user_id)
    {
        $query      =  $GLOBALS['db']->query("SELECT * FROM `pushs` WHERE `user_id` ='".$user_id."' and `out` = '0'");
        $queryTotal =  $GLOBALS['db']->resultcount();
        $siteuser   =  $GLOBALS['db']->fetchlist();
        foreach ($siteuser as $k=>$p)
        {
            $push_id    =  $p['pushid'];
            $key        =  "AAAADBwqIHs:APA91bE1pmbqVLfXKtEtGAbSf4W3G7wjr3oO5GI9Q8stBDOmSamMZCaiYBU1G2jENYLAcbkK4WhG9FGES7pADo4QpxaOxWIRQEBcRpnpSIXBlcNo4Dmwh9xm5KMzQoBN8-XoZkKVjB3P";
            $fields = array
            (

                    'to'		      => $push_id,
                    'data'            => array
                    (
                        "title"=> "Salon",
                        "body" => $message, //$message
                        "icon" => "logo"
                    ),
            );
            $headers = array (
                    'Authorization: key='.$key,
                    'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
        }

    }


	function format_data_base ($date)
	{
	    return  date('Y-m-d', strtotime($date));
	}
    function _date_format ($date)
	{
	    return  date('d/m/Y', strtotime($date));
	}

	function datepiker_format ($date)
	{
	    return  date('m/d/Y', strtotime($date));
	}

    function end_time ($start,$end)
	{
	    return  date('Y-m-d H:m:s', (strtotime($date)+($end*60)));
	}

    function time_format ($time)
	{
	    return  date('g:i A', strtotime($time));
	}

	function day_name ($_date )
	{
		$dayname = date('D', strtotime($_date));
		if($dayname == "Sat")
		{
			$_dayname = $GLOBALS['lang']['SAT']; 
		}elseif($dayname == "Sun")
		{
			$_dayname = $GLOBALS['lang']['SUN']; 
		}elseif($dayname == "Mon")
		{
			$_dayname = $GLOBALS['lang']['MON']; 
		}elseif($dayname == "Tue")
		{
			$_dayname = $GLOBALS['lang']['TUE']; 
		}elseif($dayname == "Wed")
		{
			$_dayname = $GLOBALS['lang']['WED']; 
		}elseif($dayname == "Thu")
		{
			$_dayname = $GLOBALS['lang']['THU']; 
		}elseif($dayname == "Fri")
		{
			$_dayname = $GLOBALS['lang']['FRI']; 
		}
		
		return($_dayname);

	}

    function crypto_rand_secure($min, $max)
	{
		$range = $max - $min;
		if ($range < 1) return $min; // not so random...
		$log = ceil(log($range, 2));
		$bytes = (int) ($log / 8) + 1; // length in bytes
		$bits = (int) $log + 1; // length in bits
		$filter = (int) (1 << $bits) - 1; // set all lower bits to 1
		do {
			$rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
			$rnd = $rnd & $filter; // discard irrelevant bits
		} while ($rnd > $range);
		return $min + $rnd;
	}
    
     function generateKey($length = 15)
	{
		$token 		= "";
		$key 		= "0123456789";
		$max 		= strlen($key);

		for ($i=0; $i < $length; $i++) {
			$token .= $key[crypto_rand_secure(0, $max-1)];
		}
		return ($token);
	}

    function sendemail($_mail,$_id)
    {
        $recovery_code 	= generateKey(10);
        include_once("./inc/Classes/send_email.php");
        $send    = new sendmail();

        $link    = "https://".$_SERVER['SERVER_NAME']."/fleet"."/index.php?code=".$verifiedcode;

        $_link   ='link:<a href='.$link.'>'.$GLOBALS['lang']['FOR_RECOVERY_PASSWORD'].'</a>';

        $subject = $GLOBALS['lang']['REST_PASSWORD_MESSAGE'];

        $done    = $send->email($_mail,$_link,$subject);
        if($done == 1)
        {
            $expired_date   = date('Y-m-d H:i:s', strtotime('+1 day', time()+360));
            $GLOBALS['db']->query(
                "UPDATE `users` SET
                `users_recovery_code`    ='".$recovery_code."',
                `users_recovery_expired` ='".$expired_date."'
                WHERE `users_sn`='".$_id."'
            ");
            return $done;
        }else{
            return 0;
        }
        
        
    }

    function buliddropmenu($array,$name,$table)
    {
       echo '<div class="row">
                        <div class="col">
                            <h4 class="small_title">'.$GLOBALS['lang'][$name.'S'].'</h4>
                            <div class="white-bg" id="'.$table.'">
                                <form class="company_form form2">
                                    <div class="input-group">
                                        <label for="exampleInputEmail1">'.$GLOBALS['lang'][$name].'</label>
                                        <input type="text" class="form-control" id="in" value="'.$table.'"  maxlength="25" hidden>
                                        <select name="" id="select_'.$table.'" class="select_item md-select" required>';
                                            foreach($array as $k => $v)
                                                {
                                                    echo '<option  value="'.$table.'-'.$v[$table.'_sn'].'">'.$v[$table.'_name'].'</option>'; 
                                                }
                                       echo'</select>
                                    </div>
                                    <span class="list_actions" >
                                        <i class="far fa-edit darkish-green" data-toggle="modal" data-target="#Edit_'.$name.'"></i>
                                        <i class="fas fa-trash rose" data-toggle="modal" data-target="#Delete_'.$name.'"></i>
                                    </span>
                                </form>
                                <p class="add_item pale-teal" data-toggle="modal" data-target="#Add_'.$name.'"><i class="fas fa-plus-circle darkish-green"></i>'.$GLOBALS['lang']['ADD_'.$name].'</p>
                            </div>
                        </div>
                    </div>
                    <!-- Add Modal -->
                    <div class="modal fade addModal" id="Add_'.$name.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content  dark_bg">
                              <form  class="defaultForm" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <label>'.$GLOBALS['lang']['NAME_'.$name].'</label>
                                    <input type="text" class="form-control" placeholder="'.$GLOBALS['lang']['ADD_NAME_'.$name].'" name="name" value="" maxlength="25">
                                    <input type="text" class="form-control" name="in" value="'.$table.'"  maxlength="25" hidden>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="add_name btn _btn btn-success darkish-green-bg save_Add_btn" data-dismiss="modal">'.$GLOBALS['lang']['SYS_SAVE'].'</button>
                                    <button type="button" class="btn _btn btn-danger rose-bg" data-dismiss="modal">'.$GLOBALS['lang']['SYS_CANCEL'].'</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Modal -->
                    <div class="modal fade EditModal" id="Edit_'.$name.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content  dark_bg">
                            <form class="defaultForm"  method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                <div id="'.$table.'_edit_name" class="form-group">
                                        <input type="text" id="'.$table.'_edit_name" class="form-control" placeholder="'.$GLOBALS['lang']['ADD_NAME_'.$name].'" name="name" value="'.$array[0][$table.'_name'].'" maxlength="25">
                                        <input type="text" id="'.$table.'_edit_id" class="form-control" placeholder="'.$GLOBALS['lang']['ADD_NAME_'.$name].'" maxlength="25" name="id" value="'.$array[0][$table.'_sn'].'" hidden>
                                </div>
                                        <input type="text" class="form-control" name="in" value="'.$table.'"  maxlength="25" hidden>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="update_name btn _btn btn-success darkish-green-bg save_Edit_btn" data-dismiss="modal">'.$GLOBALS['lang']['SYS_SAVE'].'</button>
                                    <button type="button" class="btn _btn btn-danger rose-bg" data-dismiss="modal">'.$GLOBALS['lang']['SYS_CANCEL'].'</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                    <!-- Delete Modal -->
                    <div class="modal fade DeleteModal" id="Delete_'.$name.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <input type="hidden" value="'.$GLOBALS['lang'][$name.'_DELETE'].'" placeholder="'.$GLOBALS['lang'][$name.'_DELETE'].'" id="'.$table.'_lang_del" >
                        <div class="modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content  dark_bg">

                                <div class="delete modal-body">
                                    <ul class="'.$table.'_delete list-group list-group-flush">';
                                    foreach($array as $k => $v)
                                    {
                                        echo '<li class="list-group-item"  id="'.'li_'.$table.'-'.$v[$table.'_sn'].'" >'.$v[$table.'_name'].'<i class="delete_name fas fa-trash rose delete_item_icon" id="'.$table.'-'.$v[$table.'_sn'].'"></i></li>';
                                    }
                                   echo'</ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn _btn btn-success darkish-green-bg save_Delete_btn" data-dismiss="modal">'.$GLOBALS['lang']['SYS_SAVE'].'</button>
                                    <button type="button" class="btn _btn btn-danger rose-bg" data-dismiss="modal">'.$GLOBALS['lang']['SYS_CANCEL'].'</button>
                                </div>
                            </div>
                        </div>
                    </div>';
    }

    function get_data($table,$return,$where,$id)
    {
        $query = $GLOBALS['db']->query(" SELECT * FROM `".$table."` WHERE `".$where."` = '".$id."' AND `".$table."_status` = '1' LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return ($_data[$return]);
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }
    function get_group_memmbers($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT * FROM `users` WHERE `users_group_id` = '".$_Id."' AND `users_status` = 1  ORDER BY `users_sn` DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else
        {
            return ($GLOBALS['lang']['NOT_FOUND']);
        }
    }
    function get_damage_memmbers($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT * FROM `car_damage` WHERE `car_damage_car_id` = '".$_Id."' AND `car_damage_status` = 0");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($queryTotal);
        }else
        {
            return (0);
        }
    }
    function project_car_own($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT `cars_sn`  FROM `cars` WHERE `cars_project_id` = '".$_Id."' AND `cars_owner_type_id` =1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($queryTotal);
        }else
        {
            return (0);
        }
    }
    function project_car_loin($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT `cars_sn`  FROM `cars` WHERE `cars_project_id` = '".$_Id."' AND `cars_owner_type_id` =2 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($queryTotal);
        }else
        {
            return (0);
        }
    }
    function get_car_datails($_id)
    {
        $query = $GLOBALS['db']->query(" SELECT * FROM `cars` WHERE `cars_sn` = '".$_id."'  LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return( '<h6 class="contact_name">'.'['.$_data['cars_model'].']'.' - '.$_data['cars_code'].'</h6>
                  <h6 class="dodger-blue"> '.$GLOBALS['lang']['CAR_MODEL'].' '.$_data['cars_year'].'</h6>
                  <h6 class="tangerine">'.$_data['cars_plate_number'].'</h6>
                  ');
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }
    function reminder_doc_number($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT `reminders_sn`  FROM `reminders` WHERE `reminders_car_id` = '".$_Id."' AND `reminders_type` = 'doc' AND `reminders_status` = 0 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($queryTotal);
        }else
        {
            return (0);
        }
    }
    function reminder_service_number($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT `reminders_sn`  FROM `reminders` WHERE `reminders_car_id` = '".$_Id."' AND `reminders_type` = 'service' AND `reminders_status` = 0 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($queryTotal);
        }else
        {
            return (0);
        }
    }
    function get_reminders_memmbers($_Id)
    {
        $query = $GLOBALS['db']->query("SELECT u.`users_sn` ,u.`users_name` FROM `reminders_members` r INNER JOIN `users` u ON u.`users_sn` = r.`reminders_members_user_id` WHERE  r.`reminders_members_reminder_id` = '".$_Id."' ORDER BY r.`reminders_members_sn` DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else
        {
            return ($GLOBALS['lang']['NOT_FOUND']);
        }
    }

	function get_day_fuel($date ,$row)
    {
        $query = $GLOBALS['db']->query("SELECT * FROM `car_fuel` WHERE `car_fuel_date` = '".$date."' ORDER BY `car_fuel_sn` DESC ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $car_fuel = $GLOBALS['db']->fetchlist();
			foreach($car_fuel as $k => $v)
			{
				echo '<tr id=tr_'.$v['car_fuel_sn'].' class="collapse order_'.$row;if($row == 0){echo ' show';}echo'">
						<td class="contact_img">
							<img height="35" src="'.$GLOBALS['path'].get_data('cars','cars_photo','cars_sn',$v['car_fuel_car_id']).'" alt="profile-pic">
						</td>
						<td>
							'.get_car_datails($v['car_fuel_car_id']).'
						</td>
						<td>
							<h6>'.$v['car_fuel_previous_read'].'</h6>
						</td>
						<td>
							<h6>'.$v['car_fuel_now_read'].'</h6>
						</td>
						<td>'.($v['car_fuel_now_read'] - $v['car_fuel_previous_read']).'</td>
						<td>
							<p class=" dodger-blue mb-0">127.25</p>
							<p class=" dodger-blue  mb-0">860</p>
						</td>
						<td>'.get_data('fuel_type','fuel_type_name','fuel_type_sn',$v['car_fuel_fuel_id']).'</td>
						<td>'.$v['car_fuel_amount'].'</td>
						<td>
							<p class="mb-0">'.$v['car_fuel_cost'].'<i class="fas fa-circle success_status ml-5"></i></p>
						</td>
						<td>
							<p class=" dodger-blue  mb-0">لا تعمل</p>
						</td>
						<td>';
						if($GLOBALS['group']['car_fuel_delete'] == 1)
						{
							echo'<a href="edit_fuel.php?f='.$v['car_fuel_sn'].'" class="mr-3"><i class="far fa-edit darkish-green"></i></a>';
							
						}
						if($GLOBALS['group']['car_fuel_delete'] == 1)
						{
							echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Delete_'.$v['car_fuel_sn'].'"></i>
									<!-- confirm delete Modal -->
									<div class="modal fade addModal" id="Delete_'.$v['car_fuel_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered " role="document">
											<div class="modal-content dark_bg">
												<div class="modal-body">
													<h5 class="white_text center">'.$GLOBALS['lang']['CONFORM_DELETE'].'</h5>
												</div>
												<div class="modal-footer" id="item_'.$k.'">
													<button type="button" id="item_'.$v['car_fuel_sn'].'" class="btn _btn  btn-light   delete" data-dismiss="modal">'.$GLOBALS['lang']['CONFORM'].'</button>
													<button type="button" class="btn _btn btn-danger rose-bg" data-dismiss="modal">'.$GLOBALS['lang']['CONFORM_CANCEL'].'</button>
												</div>
											</div>
										</div>
									</div>';
						}
					echo'</td>
					</tr>';
			}
			
        }else
        {
            return ($GLOBALS['lang']['NOT_FOUND']);
        }
    }

    function get_car_status($_id)
    {
        $query = $GLOBALS['db']->query(" SELECT s.* FROM `cars` c  INNER JOIN `car_status` s ON c.`cars_car_status` = s.`car_status_sn` WHERE c.`cars_sn` = '".$_id."'  LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return($_data['car_status_name']);
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }

    function get_car_project($_id)
    {
        $query = $GLOBALS['db']->query(" SELECT p.* FROM `cars` c  INNER JOIN `projects` p ON c.`cars_project_id` = p.`projects_sn` WHERE c.`cars_sn` = '".$_id."'  LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return($_data['projects_name']);
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }
    function get_car_supervisor($_id)
    {
        $query = $GLOBALS['db']->query(" SELECT s.* FROM `cars` c  INNER JOIN `users` s ON c.`cars_supervisor_id` = s.`users_sn` WHERE c.`cars_sn` = '".$_id."'  LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return($_data['users_name']);
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }

    function get_service_type($_id)
    {
        $query = $GLOBALS['db']->query(" SELECT * FROM `services`  WHERE `services_sn` = '".$_id."'  LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return($_data['services_name']);
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }
    function get_doc_type($_id)
    {
        $query = $GLOBALS['db']->query(" SELECT * FROM `doc_type`  WHERE `doc_type_sn` = '".$_id."'  LIMIT 1");
		$queryCount = $GLOBALS['db']->resultcount();
		if($queryCount == 1)
		{
			$_data = $GLOBALS['db']->fetchitem($query);
			return($_data['doc_type_name']);
		}
		else
		{
			return ($GLOBALS['lang']['NOT_FOUND']);
		}
    }


	









	

?>
