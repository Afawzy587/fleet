<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemservices
{
	var $tableName 	= "services";

	function getsiteservices($addon = "")
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."`  ORDER BY `services_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}

	function getTotalservices($addon = "")
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` ");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}

	function getservicesInformation($services_sn)
	{
		
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `services_sn` = '".$services_sn."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $siteservices = $GLOBALS['db']->fetchitem($query);
            return array(
                "services_sn"			                     => 		 $siteservices['services_sn'],
                "services_name"			                     => 		 $siteservices['services_name'],
                "services_notes"			                 => 		 $siteservices['services_notes'],
                "services_status"			                 => 		 $siteservices['services_status'],
            
            );
        }else{return null;}
	}

	function setservicesInformation($services)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `services_name`			            = 		'".$services['services_name']."',
            `services_notes`			        = 		'".$services['services_notes']."'
          WHERE `services_sn`    	            = 	    '".$services['services_sn']."' LIMIT 1 ");
		return 1;
	}
    
    function addNEWservices($services)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
        (`services_sn`, `services_name`, `services_notes`, `services_status`)
        VALUES (NULL,'".$services['services_name']."','".$services['services_notes']."',1)");
        return 1;
	}



}
?>
