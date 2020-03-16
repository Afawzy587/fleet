<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-groups.php");
	$groups = new systemgroups();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
		$mId = intval($_GET['g']);
		if ( $mId != 0)
		{
			$u = $groups->getgroupsInformation($mId);
			if($_POST)
			{
				$_group['groups_sn']                         =       $mId;
				$_group['system_information']                =       intval($_POST["system_information"]);
				$_group['contacts_list']                     =       intval($_POST["contacts_list"]);
				$_group['contacts_add']                      =       intval($_POST["contacts_add"]);
				$_group['contacts_edit']                     =       intval($_POST["contacts_edit"]);
				$_group['contacts_delete']                   =       intval($_POST["contacts_delete"]);
				$_group['expenses_add']                      =       intval($_POST["expenses_add"]);
				$_group['expenses_edit']                     =       intval($_POST["expenses_edit"]);
				$_group['expenses_delete']                   =       intval($_POST["expenses_delete"]);
				$_group['check_list']                        =       intval($_POST["check_list"]);
				$_group['check_item_list']                   =       intval($_POST["check_item_list"]);
				$_group['check_to_order']                    =       intval($_POST["check_to_order"]);
				$_group['end_check']                         =       intval($_POST["end_check"]);
				$_group['groups_add']                        =       intval($_POST["groups_add"]);
				$_group['groups_edit']                       =       intval($_POST["groups_edit"]);
				$_group['groups_delete']                     =       intval($_POST["groups_delete"]);
				$_group['groups_member']                     =       intval($_POST["groups_member"]);
				$_group['suppliers_list']                    =       intval($_POST["suppliers_list"]);
				$_group['suppliers_add']                     =       intval($_POST["suppliers_add"]);
				$_group['suppliers_edit']                    =       intval($_POST["suppliers_edit"]);
				$_group['suppliers_delete']                  =       intval($_POST["suppliers_delete"]);
				$_group['supply_type_add']                   =       intval($_POST["supply_type_add"]);
				$_group['projects_list']                     =       intval($_POST["projects_list"]);
				$_group['projects_add']                      =       intval($_POST["projects_add"]);
				$_group['projects_edit']                     =       intval($_POST["projects_edit"]);
				$_group['projects_delete']                   =       intval($_POST["projects_delete"]);
				$_group['car_fuel_list']                     =       intval($_POST["car_fuel_list"]);
				$_group['car_fuel_cost']                     =       intval($_POST["car_fuel_cost"]);
				$_group['car_fuel_amount']                   =       intval($_POST["car_fuel_amount"]);
				$_group['car_fuel_add']                      =       intval($_POST["car_fuel_add"]);
				$_group['car_fuel_edit']                     =       intval($_POST["car_fuel_edit"]);
				$_group['car_fuel_delete']                   =       intval($_POST["car_fuel_delete"]);
				$_group['job_orders_list']                   =       intval($_POST["job_orders_list"]);
				$_group['job_orders_add']                    =       intval($_POST["job_orders_add"]);
				$_group['job_orders_edit']                   =       intval($_POST["job_orders_edit"]);
				$_group['job_orders_delete']                 =       intval($_POST["job_orders_delete"]);
				$_group['job_orders_cost']                   =       intval($_POST["job_orders_cost"]);
				print_r($_group);
//				$edit = $groups->setgroupsInformation($_group);
//				if($edit == 1)
//				{
//					header("Location:./groups.php?message=update");
//				}
			}
		}else{
			header("Location:./error.php");
			exit;
		}
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
    <main class="">
        <form method="post"  action="privilage.php?g=<?php echo $mId;?>"  enctype="multipart/form-data">
            <div
                class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
                <h1 class="h2"><?php echo $lang['GR_CONTACTS'];?></h1>
                <div>
                    <a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href="./groups.php"><?php echo $lang['CANCEL'];?></a>
                    <button class="btn btn-success _btn darkish-green-bg mr-3" type="submit"><?php echo $lang['SAVE'];?></button>
                </div>
            </div>
            <div class="container page_body">
                <div class="row">
                    <div class="col">
                        <div class="page_body">
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <h3 class="mtb-3 small_title subtitle"><?php echo $lang['GR_NAME'];?>   : </h3>
                                <h3 class="small_title tangerine subtitle"><?php echo $u['groups_name'];?></h3>
                                <table class="datatable table white-bg contacts_table table-hover permission_table">
                                    <thead>
                                        <tr>
                                            <th><?php echo $lang['GR_MAIN'];?></th>
                                            <th><?php echo $lang['groups_name'];?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="main_tr">
                                                <input id="issues" type="checkbox" value="issues all" name="more_filter_chx" data-chx-type="issues" class="Master"
                                                       <?php if($u['check_list'] == 1 && $u['check_item_list'] == 1 && $u['check_to_order'] == 1 && $u['end_check'] == 1){ echo 'checked';}?>
                                                >
                                                <label for="issues"><?php echo $lang['GR_DAMAGE'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="car_with_issues" type="checkbox" value="1" name="check_list" data-chx-type="issues" <?php if($u['check_list'] == 1){ echo 'checked';}?>>
                                                        <label for="car_with_issues"></label>
                                                        <p><?php echo $lang['GR_CAR_WITH_DAMAGE'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="display_car_issues" type="checkbox" value="1" name="check_item_list" data-chx-type="issues" <?php if($u['check_item_list'] == 1){ echo 'checked';}?>>
                                                        <label for="display_car_issues"></label>
                                                        <p> <?php echo $lang['GR_SHOW_DAMAGE'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="issues_to_order" type="checkbox" value="1" name="check_to_order" data-chx-type="issues" <?php if($u['check_to_order'] == 1){ echo 'checked';}?>>
                                                        <label for="issues_to_order">
                                                        </label>
                                                        <p> <?php echo $lang['GR_DAMAGE_ORDER'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="close_issue" type="checkbox" value="1" name="end_check" data-chx-type="issues" <?php if($u['end_check'] == 1){ echo 'checked';}?>>
                                                        <label for="close_issue"></label>
                                                        <p> <?php echo $lang['GR_DAMAGE_CLOSE'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                      </tr>
                                      <tr>
                                            <td class="main_tr">
                                                <input id="addExpense" type="checkbox" value="addExpense all" name="more_filter_chx" data-chx-type="addExpense" class="Master"
                                                <?php if($u['expenses_add'] == 1 && $u['expenses_edit'] == 1 && $u['expenses_delete'] == 1 ){ echo 'checked';}?>>
                                                <label for="addExpense"><?php echo $lang['GR_EXPENSES'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="costs" type="checkbox" value="1" name="expenses_add" data-chx-type="addExpense"<?php if($u['expenses_add'] == 1){ echo 'checked';}?>>
                                                        <label for="costs"></label>
                                                        <p><?php echo $lang['GR_ADD_EXPEN'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="fleet_status" type="checkbox" value="1" name="expenses_edit" data-chx-type="addExpense"<?php if($u['expenses_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="fleet_status"></label>
                                                        <p><?php echo $lang['GR_EDIT_EXPEN'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="km_avg_cost" type="checkbox" value="1" name="expenses_delete" data-chx-type="addExpense"<?php if($u['expenses_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="km_avg_cost">
                                                        </label>
                                                        <p><?php echo $lang['GR_DELETE_EXPEN'];?></p>
                                                    </div>
<!--
                                                    <div class="permission_item">
                                                        <input id="costs_period" type="checkbox" value="costs_period"
                                                            name="more_filter_chx" data-chx-type="addExpense">
                                                        <label for="costs_period"></label>
                                                        <p>إضافة مورد</p>
                                                    </div>
-->
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main_tr">
                                                <input id="work_orders2" type="checkbox" value="work_orders2 all" name="more_filter_chx" data-chx-type="work_orders2" class="Master"
                                                       <?php if($u['job_orders_list'] == 1 && $u['job_orders_add'] == 1 && $u['job_orders_edit'] == 1  && $u['job_orders_delete'] == 1  && $u['job_orders_cost'] == 1 ){ echo 'checked';}?>
                                                       >
                                                <label for="work_orders2"><?php echo $lang['GR_JOB_ORDERS'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="display_work_orders2" type="checkbox" value="1" name="job_orders_list" data-chx-type="work_orders2" <?php if($u['job_orders_list'] == 1){ echo 'checked';}?>>
                                                        <label for="display_work_orders2"></label>
                                                        <p><?php echo $lang['GR_CONTACTS_VIEW'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="add_work_orders2" type="checkbox" value="1" name="job_orders_add" data-chx-type="work_orders2" <?php if($u['job_orders_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_work_orders2"></label>
                                                        <p><?php echo $lang['GR_ADD'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_work_orders2" type="checkbox" value="1" name="job_orders_edit" data-chx-type="work_orders2" <?php if($u['job_orders_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_work_orders2">
                                                        </label>
                                                        <p><?php echo $lang['GR_EDIT'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="remove_work_orders2" type="checkbox" value="1" name="job_orders_delete" data-chx-type="work_orders2" <?php if($u['job_orders_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="remove_work_orders2"></label>
                                                        <p><?php echo $lang['GR_DELETE'];?></p>
                                                    </div>
                                                    
                                                    <div class="permission_item">
                                                        <input id="edit_work_orders2" type="checkbox" value="1" name="job_orders_cost" data-chx-type="work_orders2" <?php if($u['job_orders_cost'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_work_orders2"></label>
                                                        <p><?php echo $lang['GR_TOTAL_COST'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main_tr">
                                                <input id="fuel" type="checkbox" value="fuel all" name="more_filter_chx" data-chx-type="fuel" class="Master"
                                                       <?php if($u['car_fuel_list'] == 1 && $u['car_fuel_cost'] == 1 && $u['car_fuel_amount'] == 1 && $u['car_fuel_add'] == 1  && $u['car_fuel_edit'] == 1  && $u['car_fuel_delete'] == 1 ){ echo 'checked';}?>>
                                                <label for="fuel"><?php echo $lang['FUEL'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="display_fuel" type="checkbox" value="1" name="car_fuel_list" data-chx-type="fuel" <?php if($u['car_fuel_list'] == 1){ echo 'checked';}?>>
                                                        <label for="display_fuel"></label>
                                                        <p><?php echo $lang['GR_CONTACTS_VIEW'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="fuel_cost" type="checkbox" value="1" name="car_fuel_cost" data-chx-type="fuel" <?php if($u['car_fuel_cost'] == 1){ echo 'checked';}?>>
                                                        <label for="fuel_cost"></label>
                                                        <p> <?php echo $lang['VALUE'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="fuel_quantity" type="checkbox" value="1" name="car_fuel_amount" data-chx-type="fuel" <?php if($u['car_fuel_amount'] == 1){ echo 'checked';}?>>
                                                        <label for="fuel_quantity">
                                                        </label>
                                                        <p> <?php echo $lang['QUANTITY'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="add_fuel" type="checkbox" value="1" name="car_fuel_add" data-chx-type="fuel" <?php if($u['car_fuel_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_fuel"></label>
                                                        <p><?php echo $lang['GR_ADD'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_fuel" type="checkbox" value="1" name="car_fuel_edit" data-chx-type="fuel" <?php if($u['car_fuel_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_fuel"></label>
                                                        <p><?php echo $lang['GR_EDIT'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="remove_fuel" type="checkbox" value="1" name="car_fuel_delete"  data-chx-type="fuel" <?php if($u['car_fuel_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="remove_fuel"></label>
                                                        <p><?php echo $lang['GR_DELETE'];?></p>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                       <tr>
                                            <td class="main_tr">
                                                <input id="contacts" type="checkbox" value="contacts all" name="" data-chx-type="contacts" class="Master"
                                                <?php if($u['contacts_list'] == 1 &&$u['contacts_add'] == 1 &&$u['contacts_edit'] == 1 &&$u['contacts_delete'] == 1 ){ echo 'checked';}?>
                                                >
                                                <label for="contacts"><?php echo $lang['GR_CONTACTS'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="display_contacts" type="checkbox" value="1" name="contacts_list" data-chx-type="contacts" <?php if($u['contacts_list'] == 1){ echo 'checked';}?>>
                                                        <label for="display_contacts"></label>
                                                        <p> <?php echo $lang['GR_CONTACTS_VIEW'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="add_contacts" type="checkbox" value="1" name="contacts_add" data-chx-type="contacts" <?php if($u['contacts_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_contacts"></label>
                                                        <p><?php echo $lang['GR_ADD'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_contacts" type="checkbox" value="1" name="contacts_edit" data-chx-type="contacts" <?php if($u['contacts_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_contacts">
                                                        </label>
                                                        <p><?php echo $lang['GR_EDIT'];?> </p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="remove_contacts" type="checkbox" value="1" name="contacts_delete" data-chx-type="contacts" <?php if($u['contacts_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="remove_contacts"></label>
                                                        <p><?php echo $lang['GR_DELETE'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main_tr">
                                                <input id="privlleges" type="checkbox" value="privlleges all" name="more_filter_chx" data-chx-type="privlleges" class="Master"
                                                       <?php if($u['groups_add'] == 1 &&$u['groups_edit'] == 1 &&$u['groups_delete'] == 1 &&$u['groups_member'] == 1 ){ echo 'checked';}?>
                                                       >
                                                <label for="privlleges"><?php echo $lang['GR_E_PR'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="add_group" type="checkbox" value="1" name="groups_add" data-chx-type="privlleges" <?php if($u['groups_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_group"></label>
                                                        <p><?php echo $lang['GR_ADD_GROUP'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_group" type="checkbox" value="1" name="groups_edit" data-chx-type="privlleges" <?php if($u['groups_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_group"></label>
                                                        <p><?php echo $lang['GR_EDIT_GROUP'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="remove_group" type="checkbox" value="1" name="groups_delete" data-chx-type="privlleges" <?php if($u['groups_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="remove_group">
                                                        </label>
                                                        <p><?php echo $lang['GR_DELETE_GROUP'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_group_members" type="checkbox" value="1" name="groups_member" data-chx-type="privlleges" <?php if($u['groups_member'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_group_members"></label>
                                                        <p><?php echo $lang['GR_EDIT_MEMBER'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                          <tr>
                                            <td class="main_tr">
                                                <input id="suppliers" type="checkbox" value="suppliers all" name="more_filter_chx"data-chx-type="suppliers" class="Master"
                                                       <?php if($u['suppliers_list'] == 1 &&$u['suppliers_add'] == 1 &&$u['suppliers_edit'] == 1 && $u['suppliers_delete'] == 1 && $u['supply_type_add'] == 1 ){ echo 'checked';}?>
                                                       >
                                                <label for="suppliers"><?php echo $lang['CONT_SUPLLIERS'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="display_suppliers" type="checkbox" value="1" name="suppliers_list" data-chx-type="suppliers" <?php if($u['suppliers_list'] == 1){ echo 'checked';}?>>
                                                        <label for="display_suppliers"></label>
                                                        <p> <?php echo $lang['GR_CONTACTS_VIEW'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="add_suppliers" type="checkbox" value="1" name="suppliers_add" data-chx-type="suppliers" <?php if($u['suppliers_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_suppliers"></label>
                                                        <p> <?php echo $lang['GR_ADD'];?> </p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_suppliers" type="checkbox" value="1"  name="suppliers_edit" data-chx-type="suppliers" <?php if($u['suppliers_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_suppliers">
                                                        </label>
                                                        <p><?php echo $lang['GR_EDIT'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="remove_suppliers" type="checkbox" value="1" name="suppliers_delete" data-chx-type="suppliers" <?php if($u['suppliers_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="remove_suppliers"></label>
                                                        <p><?php echo $lang['GR_DELETE'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="add_supply_type" type="checkbox" value="1" name="supply_type_add" data-chx-type="suppliers" <?php if($u['supply_type_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_supply_type"></label>
                                                        <p><?php echo $lang['GR_A_I_TYPE'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main_tr">
                                                <input id="projects" type="checkbox" value="projects all" name="more_filter_chx" data-chx-type="projects" class="Master"
                                                       <?php if($u['projects_list'] == 1 &&$u['projects_add'] == 1 &&$u['projects_edit'] == 1 && $u['projects_delete'] == 1  ){ echo 'checked';}?>
                                                       >
                                                <label for="projects"><?php echo $lang['PROJECTS'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="display_projects" type="checkbox" value="1" name="projects_list" data-chx-type="projects" <?php if($u['projects_list'] == 1){ echo 'checked';}?>>
                                                        <label for="display_projects"></label>
                                                        <p><?php echo $lang['GR_CONTACTS_VIEW'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="add_projects" type="checkbox" value="1" name="projects_add" data-chx-type="projects" <?php if($u['projects_add'] == 1){ echo 'checked';}?>>
                                                        <label for="add_projects"></label>
                                                        <p> <?php echo $lang['GR_ADD'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="edit_projects" type="checkbox" value="1" name="projects_edit" data-chx-type="projects" <?php if($u['projects_edit'] == 1){ echo 'checked';}?>>
                                                        <label for="edit_projects">
                                                        </label>
                                                        <p> <?php echo $lang['GR_EDIT'];?></p>
                                                    </div>
                                                    <div class="permission_item">
                                                        <input id="remove_projects" type="checkbox" value="1"  name="projects_delete" data-chx-type="projects" <?php if($u['projects_delete'] == 1){ echo 'checked';}?>>
                                                        <label for="remove_projects"></label>
                                                        <p> <?php echo $lang['GR_DELETE'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="main_tr">
                                                <input id="systemConfigurations" type="checkbox" value="systemConfigurations all" name="system_information" data-chx-type="systemConfigurations" class="Master" <?php if($u['system_information'] == 1){ echo 'checked';}?>>
                                                <label for="systemConfigurations"><?php echo $lang['system_information'];?></label>
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="permission_item">
                                                        <input id="edit_systemConfigurations" type="checkbox" value="1"  name="system_information" data-chx-type="systemConfigurations" <?php if($u['system_information'] == 1){ echo 'checked';}?> >
                                                        <label for="edit_systemConfigurations"></label>
                                                        <p> <?php echo $lang['EDIT_system_information'];?></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
<?php include './assets/layout/footer.php';?>