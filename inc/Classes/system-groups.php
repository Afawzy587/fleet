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
                "groups_sn"			                     => 		 $sitegroups['groups_sn'],
                "groups_name"			                 => 		 $sitegroups['groups_name'],
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
