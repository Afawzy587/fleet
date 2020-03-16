<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemgroups
{
	var $tableName 	= "groups";

	function getsitegroups($addon = "")
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `groups_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotalgroups($addon = "")
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` ");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getgroupsInformation($groups_sn)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `groups_sn` = '".$groups_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $sitegroup = $GLOBALS['db']->fetchitem($query);
            return array(
                "groups_sn"			                     => 		 $sitegroup['groups_sn'],
                "groups_name"			                 => 		 $sitegroup['groups_name'],
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
                "groups_add"                             =>          $sitegroup['groups_add'],
                "groups_edit"                            =>          $sitegroup['groups_edit'],
                "groups_delete"                          =>          $sitegroup['groups_delete'],
                "groups_member"                          =>          $sitegroup['groups_member'],
                "supply_type_add"                        =>          $sitegroup['supply_type_add'],
                "suppliers_list"                         =>          $sitegroup['suppliers_list'],
                "suppliers_add"                          =>          $sitegroup['suppliers_add'],
                "suppliers_edit"                         =>          $sitegroup['suppliers_edit'],
                "suppliers_delete"                       =>          $sitegroup['suppliers_delete'],
                "projects_list"                          =>          $sitegroup['projects_list'],
                "projects_add"                           =>          $sitegroup['projects_add'],
                "projects_edit"                          =>          $sitegroup['projects_edit'],
                "projects_delete"                        =>          $sitegroup['projects_delete'],
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
        }else{return null;}
	}

	function setgroupsInformation($groups)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `system_information`			        = 		'".$groups['system_information']."'
          WHERE `groups_sn`    	            = 	    '".$groups['groups_sn']."' LIMIT 1 ");
		return 1;
	}



}
?>
