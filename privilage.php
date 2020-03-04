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
                <h1 class="h2">خدمات الصيانة</h1>
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
                                <h3 class="mtb-3 small_title subtitle">المجموعة: </h3>
                                <h3 class="small_title tangerine subtitle">مديري النظام</h3>
                                <table class="datatable table white-bg contacts_table table-hover permission_table">
                                    <thead>
                                        <tr>
                                            <th>القائمة</th>
                                            <th>الصلاحية</th>
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