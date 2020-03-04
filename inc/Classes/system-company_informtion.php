<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class system_informations
{
	function getsiteinformation()
	{
		if($GLOBALS['login']->doCheck() == true)
		{
            $query = $GLOBALS['db']->query("SELECT * FROM `company_information` WHERE `company_information_sn` = '1' LIMIT 1 ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				$siteinformation = $GLOBALS['db']->fetchitem($query);
				return array(
					"company_information_sn"                   =>          $siteinformation['company_information_sn'],
                    "company_information_name"                 =>          $siteinformation['company_information_name'],
                    "company_information_address"              =>          $siteinformation['company_information_address'],
                    "company_information_phone"                =>          $siteinformation['company_information_phone'],
                    "company_information_photo"                =>          $siteinformation['company_information_photo'],
				);
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}
    // ################# get table data #############################//
    function getdatatable($table)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
            $query = $GLOBALS['db']->query("SELECT * FROM `".$table."` WHERE `".$table."_status` != '3' ORDER BY `".$table."_sn` DESC ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				return($GLOBALS['db']->fetchlist());
            }else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}
    // ################## edit ###########################//  
    function setsystemInformation($information)
	{
        
        if($information['image'] != "")
		{
			$queryimage = "`company_information_photo`='".$information['image']."',";
		}else
		{
			$queryimage = "";
		}
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `company_information` SET
          `company_information_name`		           	              =	         '".$information['name']."',".$queryimage."
          `company_information_address`                               =          '".$information['address']."',
          `company_information_phone`		                          =	         '".$information['phone']."'
          WHERE `company_information_sn`    	                      = 	     '1' LIMIT 1 ");
		return 1;
	}
    // ################## upload ###########################//  
    function set_logo_data($image)
	{
        
        if($image != "")
		{
            $GLOBALS['db']->query("UPDATE LOW_PRIORITY `company_information` SET
            `company_information_photo`                               =          '".$image."'
            WHERE `company_information_sn`    	                      = 	     '1' LIMIT 1 ");
		}
		
		return 1;
	}
    // ################# update function #################//
    function set_data_in_table($table,$data)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$table."` SET
			`".$table."_name`			    =	'".$data['name']."'
			WHERE `".$table."_sn` 		    = 	'".$data['id']."' LIMIT 1 ");
		return 1;
	}
    // ###################### delete function #####################//
    function delete_data_from_table($table,$id)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$table."` SET
			`".$table."_status`			    =	'3'
			WHERE `".$table."_sn` 		    = 	'".$id."' LIMIT 1 ");
		return 1;
	}
    // ################# add data function ##############//
    function addNewname($table,$data)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$table."`
        (`".$table."_sn`, `".$table."_name`, `".$table."_status`)
        VALUES (NULL,'".$data."',1)");
		return 1;
	}
    // ################ Check data  ###################//
    function CHECKNewname($table,$data)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$table."` WHERE `".$table."_name` = '".$data."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $information = $GLOBALS['db']->fetchitem($query);
            if($information[$table.'_status'] == 1)
            {
                return 1;
            }elseif($information[$table.'_status'] == 3)
            {
                $query = $GLOBALS['db']->query("DELETE LOW_PRIORITY FROM `".$table."` WHERE `".$table."_sn` = '".$information[$table.'_sn']."' LIMIT 1 ");
            }
        }else{return 0;}
	}
    
    // ################ get data  ###################//
    function getdatafortable($table,$id)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$table."` WHERE `".$table."_sn` = '".$id."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            $siteinformation = $GLOBALS['db']->fetchitem($query);
            
            return array(
                "id"                   =>          $siteinformation[$table.'_sn'],
                "name"                 =>          $siteinformation[$table.'_name'],
            );
           
        }else{return 0;}
	}
    
    
    // ############### hard delete ###############//
    function deleterowfromtable($table,$id)
	{
		$GLOBALS['db']->query("DELETE LOW_PRIORITY FROM `".$table."` WHERE `".$table."_sn` = '".$id."' LIMIT 1 ");
		return 1;
	}
    
    // ############### Groups ####################//
    function isgroupsExists($groups)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `groups` WHERE `groups_name` = '".$groups['groups_name']."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $sitegroups = $GLOBALS['db']->fetchitem($query);
            return $sitegroups['groups_sn'];
        }else{return 0;}
	}
    
    function addNewgroups($groups)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `groups`
		( `groups_sn` , `groups_name` , `groups_notes` , `groups_status`  )
		VALUES ( NULL ,  '".$groups['groups_name']."' ,  '".$groups['groups_notes']."' ,  '1')");
		return 1;
	}
    
    function setgroupsInformation($groups)
	{
       
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `groups` SET
          `groups_name`		           	 =	        '".$groups['groups_name']."',
          `groups_notes`		         =	        '".$groups['groups_notes']."'
          WHERE `groups_sn`    	         = 	        '".$groups['groups_sn']."' LIMIT 1 ");
		return 1;
	}
	
	// ############# expenses ###########//
	function isexpensesExists($name)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `expenses` WHERE `expenses_name` = '".$name."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $siteexpenses = $GLOBALS['db']->fetchitem($query);
            return 	$siteexpenses['expenses_sn'];
            
        }
	}
	function setexpensesInformation($expenses)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `expenses` SET
            `expenses_name`			        = 		'".$expenses['expenses_name']."'
          WHERE `expenses_sn`    	        = 	    '".$expenses['expenses_sn']."' LIMIT 1 ");
		return 1;
	}
	function addNewexpenses($expenses)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `expenses`
		(`expenses_sn`, `expenses_name`,`expenses_status`)
		VALUES ( NULL ,  '".$expenses['expenses_name']."' ,  '1')"); 
	}
	function deleteexpenses($expenses_sn)
	{
		$GLOBALS['db']->query("DELETE LOW_PRIORITY FROM `expenses` WHERE `expenses_sn` = '".$expenses_sn."' LIMIT 1 ");
		return 1;
	}
    
    //***************** project routes *****************//
    function getprojectroutes($table)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
            $query = $GLOBALS['db']->query("SELECT * FROM `project_roads` WHERE `project_roads_project_id` = '".$table."' ORDER BY `project_roads_sn` DESC ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				return($GLOBALS['db']->fetchlist());
            }else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}
}
?>
