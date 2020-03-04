<?php if(!defined("inside")) exit;
class systemsuppliers
{
	var $tableName 	= "suppliers";

	function getsitesuppliers($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` ORDER BY `suppliers_sn` DESC ".$addon);
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				return($GLOBALS['db']->fetchlist());
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function getTotalsuppliers($addon = "")
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query 				= $GLOBALS['db']->query("SELECT COUNT(*) AS `total` FROM `".$this->tableName."` ");
			$queryTotal 		= $GLOBALS['db']->fetchrow();
			$total 				= $queryTotal['total'];
			return ($total);
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function getsuppliersInformation($suppliers_sn)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
            $query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `suppliers_sn` = '".$suppliers_sn."' LIMIT 1 ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal > 0)
			{
				$sitesuppliers = $GLOBALS['db']->fetchitem($query);
				return array(
					"suppliers_sn"			            => 		$sitesuppliers['suppliers_sn'],
					"suppliers_name"			        => 		$sitesuppliers['suppliers_name'],
					"suppliers_supply_id"			    => 		$sitesuppliers['suppliers_supply_id'],
					"suppliers_accountable_id"			=> 		$sitesuppliers['suppliers_accountable_id'],
					"suppliers_phone"			        => 		$sitesuppliers['suppliers_phone'],
					"suppliers_contract_start"			=> 		$sitesuppliers['suppliers_contract_start'],
					"suppliers_contract_end"			=> 		$sitesuppliers['suppliers_contract_end'],
					"suppliers_address"			        => 		$sitesuppliers['suppliers_address'],
					"suppliers_city"			        => 		$sitesuppliers['suppliers_city'],
					"suppliers_email"			        => 		$sitesuppliers['suppliers_email'],
					"suppliers_status"			        => 		$sitesuppliers['suppliers_status']
				);
			}else{return null;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}
	
	function issuppliersExists($name)
	{
		if($GLOBALS['login']->doCheck() == true)
		{
			$query = $GLOBALS['db']->query("SELECT * FROM `".$this->tableName."` WHERE `group_name` = '".$name."' LIMIT 1 ");
			$queryTotal = $GLOBALS['db']->resultcount();
			if($queryTotal == 1)
			{
				$sitesuppliers = $GLOBALS['db']->fetchitem($query);
				return array(
					"suppliers_sn"			            => 		$sitesuppliers['suppliers_sn']
				);
			}else{return true;}
		}else{$GLOBALS['login']->doDestroy();return false;}
	}

	function setsuppliersInformation($suppliers)
	{
		$GLOBALS['db']->query("UPDATE LOW_PRIORITY `".$this->tableName."` SET
          `suppliers_name`                   =          '".$suppliers['suppliers_name']."',
          `suppliers_supply_id`              =          '".$suppliers['suppliers_supply_id']."',
          `suppliers_accountable_id`         =          '".$suppliers['suppliers_accountable_id']."',
          `suppliers_phone`                  =          '".$suppliers['suppliers_phone']."',
          `suppliers_contract_start`         =          '".$suppliers['suppliers_contract_start']."',
          `suppliers_contract_end`           =          '".$suppliers['suppliers_contract_end']."',
          `suppliers_address`                =          '".$suppliers['suppliers_address']."',
          `suppliers_city`                   =          '".$suppliers['suppliers_city']."',
          `suppliers_email`                  =          '".$suppliers['suppliers_email']."'
          WHERE `suppliers_sn`    	         = 	        '".$suppliers['suppliers_sn']."' LIMIT 1 ");
		return 1;
	}

	function addNewsuppliers($suppliers)
	{
		$GLOBALS['db']->query("INSERT LOW_PRIORITY INTO `".$this->tableName."`
		(`suppliers_sn`, `suppliers_name`, `suppliers_supply_id`, `suppliers_accountable_id`, `suppliers_phone`, `suppliers_contract_start`, `suppliers_contract_end`, `suppliers_address`, `suppliers_city`, `suppliers_email`, `suppliers_status`)
		VALUES ( NULL ,  '".$suppliers['suppliers_name']."',  '".$suppliers['suppliers_supply_id']."' ,  '".$suppliers['suppliers_accountable_id']."',  '".$suppliers['suppliers_phone']."' ,  '".$suppliers['suppliers_contract_start']."',  '".$suppliers['suppliers_contract_end']."' ,  '".$suppliers['suppliers_address']."',  '".$suppliers['suppliers_city']."' ,  '".$suppliers['suppliers_email']."',  '1')");
		return 1;
	}


}
?>
