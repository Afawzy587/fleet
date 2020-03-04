<?php  if(!defined("inside"))  exit;?>
<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    //start session
	error_reporting (E_ALL ^ E_NOTICE);
    ######### Main PATHs #########
	define('INCLUDES_PATH',	dirname(__FILE__) 	. DIRECTORY_SEPARATOR);
	define('CLASSES_PATH',	INCLUDES_PATH 		. "Classes" . DIRECTORY_SEPARATOR);
	define('ROOT_PATH',		INCLUDES_PATH 		. ".." 		. DIRECTORY_SEPARATOR);
	define('ASSETS_PATH', 	ROOT_PATH 			. "assets"	. DIRECTORY_SEPARATOR);
    #########  Db & config Files  #########
	include(CLASSES_PATH 	. 	"database.class.php");
	include(INCLUDES_PATH 	. 	"config.php");
	include(ASSETS_PATH		.	"assets.php");
    ######### Admin Authorization Class #########
	include(CLASSES_PATH 	."login_class.php");
	$login = new loginClass();
    $basicLimit = 5;
    ######## LOGS #############################
    include(CLASSES_PATH  ."system.logs.php");
	$logs = new logs();
    ######## Image path #######################
    $upload_path ='./uploads';
    $path ='./uploads/';
    ######### Language files #########
    include("./assets/Languages/lang.php");

    ///*********Image ***///////
    $avater = "/defaults/avater.jpg";

    //############ company information #############//
    $query = $GLOBALS['db']->query("SELECT * FROM `company_information` WHERE `company_information_sn` = '1' LIMIT 1 ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				$siteinformation = $GLOBALS['db']->fetchitem($query);
				$company = array(
					"company_information_sn"                   =>          $siteinformation['company_information_sn'],
                    "company_information_name"                 =>          $siteinformation['company_information_name'],
                    "company_information_address"              =>          $siteinformation['company_information_address'],
                    "company_information_phone"                =>          $siteinformation['company_information_phone'],
                    "company_information_photo"                =>          $siteinformation['company_information_photo'],
				);
			}else{return null;}

    ######## user information ################
    $query = $GLOBALS['db']->query("SELECT * FROM `users` WHERE `users_sn` = '".$_SESSION['id']."' LIMIT 1 ");
    $queryTotal = $GLOBALS['db']->resultcount();
    if($queryTotal > 0)
    {
        $siteinformation = $GLOBALS['db']->fetchitem($query);

        $user_login     = array(
            "users_name"                     =>          $siteinformation['users_name'],
            "users_photo"                    =>          $siteinformation['users_photo'],

        );
    }

    ######## permission for user login #######
    $query = $GLOBALS['db']->query("SELECT * FROM `groups` g INNER JOIN `users` u ON u.`users_group_id` = g.`groups_sn`  WHERE u.`users_sn` = '".$_SESSION['id']."' AND `groups_status` != 3 LIMIT 1 ");
    $queryTotal = $GLOBALS['db']->resultcount();
    if($queryTotal > 0)
    {
        $sitegroup = $GLOBALS['db']->fetchitem($query);
        if ($sitegroup['users_group_id'] == -1)
        {
            $group     = array(
            "system_information"                      =>          1,
            "contacts_list"                           =>          1,
            "contacts_add"                            =>          1,
            "contacts_edit"                           =>          1,
            "contacts_delete"                         =>          1,
            "expenses_add"                            =>          1,
            "expenses_edit"                           =>          1,
            "expenses_delete"                         =>          1,
            "cars_list"                               =>          1,
            "cars_add"                                =>          1,
            "cars_back_up"                            =>          1,
            "cars_order"                              =>          1,
            "cars_delete"                             =>          1,
            "cars_add_expenses"                       =>          1
                );

        }else{
            $group     = array(
            "system_information"                     =>          $sitegroup['system_information'],
            "contacts_list"                          =>          $sitegroup['contacts_list'],
            "contacts_add"                           =>          $sitegroup['contacts_add'],
            "contacts_edit"                          =>          $sitegroup['contacts_edit'],
            "contacts_delete"                        =>          $sitegroup['contacts_delete'],
            "expenses_add"                           =>          $sitegroup['expenses_add'],
            "expenses_edit"                          =>          $sitegroup['expenses_edit'],
            "expenses_delete"                        =>          $sitegroup['expenses_delete'],
            "cars_list"                              =>          $sitegroup['cars_list'],
            "cars_add"                               =>          $sitegroup['cars_add'],
            "cars_edit"                              =>          $sitegroup['cars_edit'],
            "cars_delete"                            =>          $sitegroup['cars_delete'],
            "cars_back_up"                           =>          $sitegroup['cars_back_up'],
            "cars_order"                             =>          $sitegroup['cars_order'],
            "cars_add_expenses"                      =>          $sitegroup['cars_add_expenses'],
            "check_list"                             =>          $sitegroup['check_list'],
            "check_item_list"                        =>          $sitegroup['check_item_list'],
            "check_to_order"                         =>          $sitegroup['check_to_order'],
            "end_check"                              =>          $sitegroup['end_check'],
                );
        
      }
    }


    ///*********Image ***///////

    $avater_default = "/defaults/profile-icon.png";

    //************** page name ********************//
    $basename      =   basename($_SERVER['PHP_SELF']);
    $page_name     =   str_replace(".php","",$basename);



?>
