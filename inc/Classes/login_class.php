<?php if(!defined("inside")) exit;

class loginClass
{
 var $name;
 var $email;
 var $password;
 var $remember;
 var $id;
 var $tableName 	= "users";
 function doLogin($email,$pass,$remember)
 {
 	if($email !=""  || $pass != "")
 	{
 		if($this->isLogged() == false)
        {
	 		global $db;
		 	$query = $db->query("SELECT * FROM `".$this->tableName."` WHERE `users_email`='".$email."' AND `users_status` !='3' AND `users_kick` = '0'  LIMIT 1");
            $queryTotal = $db->resultcount();
		    if($queryTotal == 1)
		    {
				$userData = $db->fetchitem($query);
				if (password_verify($pass, $userData['users_password']))
                {
                    // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
                    session_start();
                    session_regenerate_id();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['name']     = $userData['users_name'];
                    $_SESSION['photo']    = $userData['users_photo'];
                    $_SESSION['email']    = $userData['users_email'];
                    $_SESSION['id']       = $userData['users_sn'];
                    $query = $db->query("UPDATE `".$this->tableName."` SET `users_last_login`= NOW() WHERE `users_sn`='".$userData['users_sn']."'");
                    return 1; // login success
                } else {
                    return 2; // Incorrect password!
                }
		    }else{
                return 3; // user not found
            }
	 	}else{
            return 4; // login before
        }
 	}else{
        return 0;  // empty data
    }
 }
 function doLogout()
 {
 	if($this->isLogged() == true)
 	{
 		// query and get data from db
 		$this->doDestroy();
 		return  true;
 	}else{return false;}
 }
 function doDestroy()
 {
 	session_start();
    session_unset();
    session_destroy();
    session_write_close();
 }
 function doCheck()
 {
 	if($this->isLogged() == true)
 	{
 		global $db;
	  	$email = $_SESSION['email'];
	 	$id    = $_SESSION['id'];
		$query = $db->query("SELECT * FROM `".$this->tableName."` WHERE `users_email`='$email' AND `users_sn`='$id' ");
 		$queryTotal = $db->resultcount();
	    if($queryTotal == 1)
	    {
			return true;
	    }else{
            $this->doDestroy();
            return false;
        }
 	}else{
        $this->doDestroy();
        return false;
    }
 }
 function getUserInformation()
 {
 	if($this->isLogged() == true)
 	{
 		global $db;
	 	$email = $_SESSION['email'];
	 	$id    = $_SESSION['id'];
	 	$query = $db->query("SELECT * FROM `".$this->tableName."` WHERE `users_email`='$email' AND `user_serial`='$id' LIMIT 1 ");
 		$queryTotal = $db->resultcount();
	    if($queryTotal == 1)
	    {
	    	$userInformation = $db->fetchitem($query);
			return array(
                "users_name"			    	        => 		$userInformation['users_name'],
                "users_managment_id"    		        => 		$userInformation['users_managment_id'],
                "users_job_id"		                    => 		$userInformation['users_job_id'],
                "users_qualification"      		        => 		$userInformation['users_qualification'],
                "users_birthday"		                => 		$userInformation['users_birthday'],
                "users_hiring_date"		                => 		$userInformation['users_hiring_date'],
                "users_phone"		                    => 		$userInformation['users_phone'],
                "users_email"		                    => 		$userInformation['users_email'],
                "users_job_serial"		                => 		$userInformation['users_job_serial'],
                "users_net_salary"		                => 		$userInformation['users_net_salary'],
                "users_salary_exchanges"		        => 		$userInformation['users_salary_exchanges'],
                "users_photo"		                    => 		$userInformation['users_photo'],
                "users_personal_id"		                => 		$userInformation['users_personal_id'],
                "users_license_id"		                => 		$userInformation['users_license_id'],
                "users_license_place"		            => 		$userInformation['users_license_place'],
                "users_license_expired"		            => 		$userInformation['users_license_expired'],
                "users_contract_finish"		            => 		$userInformation['users_contract_finish'],
                "users_contract_photo"		            => 		$userInformation['users_contract_photo'],
                "users_notes"		                    => 		$userInformation['users_notes'],
                "users_username"		                => 		$userInformation['users_username'],
                "users_password"		                => 		$userInformation['users_password'],
                "users_group_id"		                => 		$userInformation['users_group_id'],
                "users_last_login"		                => 		$userInformation['users_last_login'],
                "users_status"		                    => 		$userInformation['users_status'],
                "users_kick"		                    => 		$userInformation['users_kick'],
			);
	    }else{$this->doDestroy();return false;}
 	}else{$this->doDestroy();return false;}
 }
 function isLogged()
 {
 	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){return true;}else{return false;}
 }
 function checkmailisfound($email)
 {
    global $db;
    $query = $db->query("SELECT * FROM `".$this->tableName."` WHERE `users_email`='".$email."' AND `users_status` !='3' AND `users_kick` = '0'  LIMIT 1");
    $queryTotal = $db->resultcount();
    if($queryTotal == 1)
    {
        $userData = $db->fetchitem($query);
        if($userData['users_recovery_code'] != 0 && (strtotime($userData['users_recovery_expired']) > time()))
        {
            return 'send';
        }else{
            return $userData['users_sn'];
        }
    }else{
        return 0;
    }
	 
 }

}



?>
