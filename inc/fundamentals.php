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
            "cars_add_expenses"                       =>          1,
            "projects_list"                           =>          1,
            "projects_add"                            =>          1,
            "projects_edit"                           =>          1,
            "projects_delete"                         =>          1,
            "car_fuel_list"                           =>          1,
            "car_fuel_add"                            =>          1,
            "car_fuel_edit"                           =>          1,
            "car_fuel_delete"                         =>          1,
            "reminders_list"                          =>          1,
            "reminders_add"                           =>          1,
            "reminders_edit"                          =>          1,
            "reminders_delete"                        =>          1,
            "services_list"                           =>          1,
            "services_add"                            =>          1,
            "services_edit"                           =>          1,
            "services_delete"                         =>          1, 
			"job_orders_list"                         =>          1,
            "job_orders_add"                          =>          1,
            "job_orders_edit"                         =>          1,
            "job_orders_delete"                       =>          1, 
            "groups_add"                              =>          1,
            "groups_edit"                             =>          1,
            "groups_delete"                           =>          1,
            "groups_member"                           =>          1,      
                
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
            "check_item_delete"                      =>          $sitegroup['check_item_delete'],
            "check_item_edit"                        =>          $sitegroup['check_item_edit'],
            "check_to_order"                         =>          $sitegroup['check_to_order'],
            "end_check"                              =>          $sitegroup['end_check'],
            "projects_list"                          =>          $sitegroup['projects_list'],
            "projects_add"                           =>          $sitegroup['projects_add'],
            "projects_edit"                          =>          $sitegroup['projects_edit'],
            "projects_delete"                        =>          $sitegroup['projects_delete'],
            "reminders_list"                         =>          $sitegroup['reminders_list'],
            "reminders_add"                          =>          $sitegroup['reminders_add'],
            "reminders_edit"                         =>          $sitegroup['reminders_edit'],
            "reminders_delete"                       =>          $sitegroup['reminders_delete'],
            "services_list"                          =>          $sitegroup['services_list'],
            "services_add"                           =>          $sitegroup['services_add'],
            "services_edit"                          =>          $sitegroup['services_edit'],
            "services_delete"                        =>          $sitegroup['services_delete'],   
            "groups_add"                             =>          $sitegroup['groups_add'],
            "groups_edit"                            =>          $sitegroup['groups_edit'],
            "groups_delete"                          =>          $sitegroup['groups_delete'],
            "groups_member"                          =>          $sitegroup['groups_member'],
            "supply_type_add"                        =>          $sitegroup['supply_type_add'],
            "suppliers_list"                         =>          $sitegroup['suppliers_list'],
            "suppliers_add"                          =>          $sitegroup['suppliers_add'],
            "suppliers_edit"                         =>          $sitegroup['suppliers_edit'],
            "suppliers_delete"                       =>          $sitegroup['suppliers_delete'],
            "car_fuel_cost"                          =>          $sitegroup['car_fuel_cost'],
            "car_fuel_amount"                        =>          $sitegroup['car_fuel_amount'],
            "car_fuel_list"                          =>          $sitegroup['car_fuel_list'],
            "car_fuel_add"                           =>          $sitegroup['car_fuel_add'],
            "car_fuel_edit"                          =>          $sitegroup['car_fuel_edit'],
            "car_fuel_delete"                        =>          $sitegroup['car_fuel_delete'],
            "job_orders_list"                        =>          $sitegroup['job_orders_list'],
            "job_orders_add"                         =>          $sitegroup['job_orders_add'],
            "job_orders_edit"                        =>          $sitegroup['job_orders_edit'],
            "job_orders_delete"                      =>          $sitegroup['job_orders_delete'],
            "job_orders_cost"                        =>          $sitegroup['job_orders_cost'],
                );
        
      }
    }


    ///*********Image ***///////

    $avater_default = "/defaults/profile-icon.png";

    //************** page name ********************//
    $basename      =   basename($_SERVER['PHP_SELF']);
    $page_name     =   str_replace(".php","",$basename);



?>
