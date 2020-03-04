<?php if(!defined("inside")) exit;
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
class systemexpenses
{
	var $tableName 	= "expenses";
	function getsiteexpenses($addon = "")
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `expenses_status` = '1' ORDER BY `expenses_sn`  DESC ".$addon);
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal > 0)
        {
            return($GLOBALS['db']->fetchlist());
        }else{return null;}
	}
	function getTotalexpenses($addon = "")
	{
        $query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` WHERE `expenses_sn` !='".$_SESSION['id']."'");
        $queryTotal 		= $GLOBALS['db']->fetchrow();
        $total 				= $queryTotal['total'];
        return ($total);
	}
	function isexpensesExists($name)
	{
        $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `expenses_name` = '".$name."' LIMIT 1 ");
        $queryTotal = $GLOBALS['db']->resultcount();
        if($queryTotal == 1)
        {
            $siteexpenses = $GLOBALS['db']->fetchitem($query);
            return array(
                "expenses_sn"			            => 		$siteexpenses['expenses_sn']
            );
        }else{return true;}
	}
	function setexpensesInformation($expenses)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
            `expenses_name`			        = 		'".$expenses['expenses_name']."'
          WHERE `expenses_sn`    	        = 	    '".$expenses['expenses_sn']."' LIMIT 1 ");
		return 1;
	}
	function addNewexpenses($expenses)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`expenses_sn`, `expenses_name`,`expenses_status`)
		VALUES ( NULL ,  '".$expenses['expenses_name']."' ,  '".$expenses['expenses_status']."')"); 
	}
	
	function add_car_expenses($expenses)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `car_expenses`
		(`car_expenses_sn`, `car_expenses_car_id`, `car_expenses_expense_id`, `car_expenses_supply_id`, `car_expenses_date`, `car_expenses_by`, `car_expenses_doc`, `car_expenses_status`) 
		VALUES ( NULL ,  '".$expenses['car_expenses_car_id']."' ,  '".$expenses['car_expenses_expense_id']."',  '".$expenses['car_expenses_supply_id']."',  '".$expenses['car_expenses_date']."',  '".$expenses['car_expenses_by']."',  '".$expenses['car_expenses_doc']."',1)"); 
	}
	function deleteexpenses($expenses_sn)
	{
		$GLOBALS['db']->query("DELETE LOW_PRIORITY FROM `".$this->tableName."` WHERE `expenses_sn` = '".$expenses_sn."' LIMIT 1 ");
		return 1;
	}
}
?>
