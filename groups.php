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
    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['contacts_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                include("./inc/Classes/pager.class.php");
                $page;
                $pager         = new pager();
                $page 		   = intval($_GET['page']);
                $total         = $groups->getTotalgroups();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"groups.php".$paginationAddons,$paginationDialm);
                $thispage      = $pager->getPage();
                $limitmequry   = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager         = $pager->getAnalysis();
                $groups        = $groups->getsitegroups($limitmequry);
                $managements   = $informations->getdatatable("management");  
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"groups",
                            "mode" 		        => 	"list",
                            "total" 		    => 	$total,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
            }
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
<main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h1 class="h2"><?php echo $lang['CONT_TITLE'];?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                        <?php
                            if($group['groups_add'] == 1)
                            {
                                echo '<button class="btn dark_btn" data-toggle="modal" data-target="#AddModalCenter">'.$lang['GR_ADD'].' </button>';
                            }
                        ?>
                </div>
            </div>
            <!-- Add Modal -->
            <div class="modal fade addModal" id="AddModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            xx
                        </div>
                        <form name="add-group-form" method="post"  class="needs-validation" novalidate>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label><?php echo $lang['GR_NAME'];?></label>
                                    <div>
                                        <input type="text" class="form-control" placeholder="<?php echo $lang['GR_NAME'];?>" name="name" required maxlength="25" >
                                            <div class="invalid-feedback">
                                                <?php echo $lang['GR_ADD_NAME'];?>
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><?php echo $lang['GR_DESCRIPTION'];?></label>
                                    <div>
                                        <textarea placeholder="<?php echo $lang['GR_DESCRIPTION'];?>" class="form-control" cols="20" rows="5" name="description"
                                            required></textarea>
                                            <div class="invalid-feedback">
                                                <?php echo $lang['GR_ADD_DESCRIPTION'];?>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="add_group btn _btn btn-success dark_btn save_Add_btn"
                                  ><?php echo $lang['SAVE'];?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li <?php if($page_name == "users"){echo "class='active'";}?>>
                            <a href="./users.php"><?php echo $lang['CONT_TITLE'];?></a>
                        </li>
                        <li <?php if($page_name == "groups"){echo "class='active'";}?>>
                            <a href="./groups.php"><?php echo $lang['CONT_GROUPS'];?>
                            </a>
                        </li>
                        <li <?php if($page_name == "suppliers"){echo "class='active'";}?>>
                            <a href="./suppliers.php"><?php echo $lang['CONT_SUPLLIERS'];?></a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <h3 class="mtb-3 small_title"><?php echo $lang['GR_USER_GROUPS'];?></h3>
                            <input type="hidden" value="groups" id="table">
                            <input type="hidden" value="contacts_delete" id="permission">
                            <div class="tab-pane active" id="previousIssue">
                                
                                <table class="table table-class white-bg contacts_table table-hover" >
                                <?php  if(empty($groups))
                                    {
                                        echo "<tr><th colspan=\"5\">".$lang['US_NO_groups']."</th></tr>";
                                    }else{
                                        echo '
                                        <thead>
                                            <tr>
                                                <th>'.$lang['GR_NAME'].'</th>
                                                <th>'.$lang['GR_DESCRIPTION'].'</th>
                                                <th>'.$lang['GR_MEMMBERS'].'</th>
                                                <th>'.$lang['GR_SETTING'].'</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        foreach($groups as $k => $u){
                                            echo'<tr id=tr_'.$u['groups_sn'].'>
                                                <td>'
                                                    .$u['groups_name'].
                                                '</td>
                                                <td>'
                                                    .$u['groups_notes'].
                                                '</td>
                                                <td>';
                                                    if (is_array(get_group_memmbers($u['groups_sn'])))
                                                     {
                                                          echo get_group_memmbers($u['groups_sn'])[0]['users_name'].'،'.get_group_memmbers($u['groups_sn'])[1]['users_name'];
                                                     }else{
                                                        echo $lang['NOT_FOUND'];
                                                    }
                                                echo'</td>
                                                <td>';
                                                if($group['groups_edit'] == 1)
                                                {
                                                    echo'<a href="./privilage.php?g='.$u['groups_sn'].'"><i class="fas fa-lock tangerine"></i></a>';
                                                }
                                                if($group['groups_member'] == 1)
                                                {
                                                    echo' <i class="fas fa-user-friends" data-toggle="modal" data-target="#Edit_'.$u['groups_sn'].'"></i>';
                                                }
                                                if($group['groups_edit'] == 1)
                                                {
                                                    echo '<i class="far fa-edit darkish-green" data-toggle="modal" data-target="#Edit_contact_'.$u['groups_sn'].'"></i>
                                                        <!-- edit contact Modal -->
                                                        <div class="modal fade addModal" id="Edit_contact_'.$u['groups_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered " role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    </div>
                                                                    <form name="add-group-form" method="post"  class="needs-validation" novalidate>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label>'.$lang['GR_NAME'].'</label>
                                                                                <div>
                                                                                    <input type="text" class="form-control" placeholder="'.$lang['GR_NAME'].'" id="name_'.$u['groups_sn'].'"  name="name" value ="'.$u['groups_name'].'" maxlength="25" required>
                                                                                    <div class="invalid-feedback">
                                                                                        '.$lang['GR_ADD_NAME'].'
                                                                                    </div>
                                                                                </div>
                                                                                <input type="text" class="form-control" placeholder="'.$lang['GR_NAME'].'" name="id" value ="'.$u['groups_sn'].'" maxlength="25" required hidden>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>'.$lang['GR_DESCRIPTION'].'</label>
                                                                                <textarea placeholder="'.$lang['SAVE'].'" class="form-control" cols="20" rows="5" id="description_'.$u['groups_sn'].'" name="description"  required>'.$u['groups_notes'].'</textarea>
                                                                                <div class="invalid-feedback">
                                                                                    '.$lang['GR_ADD_DESCRIPTION'].'
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" id="'.$u['groups_sn'].'" class="edit_group btn _btn btn-success dark_btn save_Add_btn" data-dismiss="modal">'.$lang['SAVE'].'</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                }
                                                if($group['groups_delete'] == 1)
                                                {

                                                    echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Delete_'.$u['groups_sn'].'"></i>
                                                        <!-- confirm delete Modal -->
                                                        <div class="modal fade addModal" id="Delete_'.$u['groups_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered " role="document">
                                                                <div class="modal-content dark_bg">

                                                                    <div class="modal-body">
                                                                        <h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
                                                                    </div>
                                                                    <div class="modal-footer" id="item_'.$k.'">
                                                                        <button type="button" class="btn _btn btn-light" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
                                                                        <button type="button" id="item_'.$u['groups_sn'].'" class="btn _btn btn-danger rose-bg  delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    ';
                                                }
                                                echo '
                                                </td>
                                                </tr>
                                                
                                            
                                                
                                                <!-- Edit Modal -->
                                    <div class="modal fade groupsModal" id="Edit_'.$u['groups_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <i class="fa fa-times-circle" data-dismiss="modal"></i>
                                                </div>
                                                <form>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="white-bg">
                                                                    <p class="small_title">'.$lang['SYS_MANAGEMENT'].'</p>
                                                                    <ul class="nav modal_sidenav " role="tablist" id="myTab">';
                                                                    foreach($managements as $k => $v)
                                                                    {
                                                                        echo '<li ><a href="#group_'.($k+1).'" role="tab" data-toggle="tab">'.$v['management_name'].'</a></li>';
                                                                    }
                                                                    echo'</ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <div class="tab-content">
                                                                    <div class="tab-pane " id="previousIssue">
                                                                        Previous issue
                                                                    </div>
                                                                    <div class="tab-pane active" id="group1">
                                                                        <div class="grey_bg">
                                                                            <ul class="modal_nav_body">
                                                                                <li class="row_title">
                                                                                    <p class="small_title">'.$lang['GR_GROUP_MEMMBERS'].'</p>
                                                                                </li>';
                                                                                if(is_array(get_group_memmbers($u['groups_sn'])))
                                                                                {
                                                                                    foreach(get_group_memmbers($u['groups_sn']) as $k => $v)
                                                                                    {
                                                                                      echo'<li>
                                                                                                <input id="group_'.$v['users_sn'].'" type="checkbox" value="group_'.$v['users_sn'].'" name="more_filter_chx" checked>
                                                                                                <label for="group_'.$v['users_sn'].'">'.$v['users_name'].'</label>
                                                                                            </li>';
                                                                                    }
                                                                                }
                                                                                  
                                                                                
                                                                            echo'</ul>

                                                                        </div>
                                                                        <div class="white-bg">
                                                                                <ul class="modal_nav_body">
                                                                                        <li class="row_title">
                                                                                            <p class="small_title">اللادارة العامة</p>
                                                                                        </li>
                                                                                        <li>
                                                                                            <input id="contact1" type="checkbox" value="contact1" name="more_filter_chx" >
                                                                                            <label for="contact1">موظف1</label>
                                                                                        </li>
                                                                                        <li>
                                                                                                <input id="contact1" type="checkbox" value="contact1" name="more_filter_chx" >
                                                                                                <label for="contact1">موظف1</label>
                                                                                            </li>
                                                                                            <li>
                                                                                                    <input id="contact1" type="checkbox" value="contact1" name="more_filter_chx" >
                                                                                                    <label for="contact1">موظف1</label>
                                                                                                </li>
                                                                                    </ul>

                                                                        </div>
                                                                        <div class="grey_bg groupModalFooter">
                                                                            <button type="submit" class="btn _btn btn-success dark_btn save_Add_btn" data-dismiss="modal">حفظ</button>

                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane" id="group2">Next issue2</div>
                                                                    <div class="tab-pane" id="group3">Next issue3</div>
                                                                    <div class="tab-pane" id="group4">Next issue4</div>
                                                                    <div class="tab-pane" id="group5">Next issue5</div>
                                                                    <div class="tab-pane" id="group6">Next issue5</div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                            <tbody>
                                            ';
                                            
                                        }
                                    }?>    
                                </table>

                                <!--		Start Pagination -->
                                <div class='pull-left pagination-container'>
                                    <?php echo $pager;?>
                                </div>
                                <!-- <div class="rows_count">Showing 11 to 20 of 91 entries</div> -->

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script>
                (function () {
            'use strict';
            window.addEventListener('load', function () {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');

                    }, false);
                });
            }, false);
        })();
    </script>
<?php include './assets/layout/footer.php';?>
