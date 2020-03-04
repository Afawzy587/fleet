<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-suppliers.php");
	$suppliers = new systemsuppliers();
     
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
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $suppliers->getTotalsuppliers();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"suppliers.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $suppliers       = $suppliers->getsitesuppliers($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"suppliers",
                            "mode" 		        => 	"list",
                            "total" 		    => 	$total,
                            "id" 	        	=>	$_SESSION['id'],
                        ),"admin",$_SESSION['id'],1
                    );
                    if($_GET['message']== "update")
                    {
                      $message = $lang['edit_suppliers_success'];
                    }elseif($_GET['message']== "add"){
                      $message = $lang['add_suppliers_success'];
                    }elseif($_GET['message']== "delete"){
                      $message = $lang['delete_suppliers_success'];
                    }
            }
//            break;


        
    
    }
    include './assets/layout/header.php';
    include './assets/layout/navbar.php';
?>
<main class="">
        <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <h1 class="h2"><?php echo $lang['CONT_TITLE'];?></h1>
            <?php if ($message){
							echo '<div class="alert alert-success">'.$message.'</div>';
						}
					?>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                       
                        <?php
                            if($group['contacts_add'] == 1)
                            {
                                echo '<button class="btn dark_btn"><a href="./add_supplier.php">'.$lang['SU_ADD'].'</a></button>';
                            }
                        ?>
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
<!--                        <div class="tab-content">-->
                            <input type="hidden" value="suppliers" id="table">
                            <input type="hidden" value="contacts_delete" id="permission">
<!--                            <div class="tab-pane active" id="previousIssue">-->
                                <table class="datatable table white-bg contacts_table table-hover mt-5" >
                                <?php  if(empty($suppliers))
                                    {
                                        echo "<tr><th colspan=\"5\">".$lang['SU_NO_suppliers']."</th></tr>";
                                    }else{
                                        echo '
                                        <thead>
                                            <tr>
                                                <th >'.$lang['NAME'].'</th>
                                                <th>'.$lang['SUPPLY_TYPE'].'</th>
                                                <th class="wide_col">'.$lang['RESPONSIBLE'].'</th>
                                                <th>'.$lang['CITY'].'</th>
                                                <th>'.$lang['PHONE'].'</th>
                                                <th>'.$lang['EMAIL'].'</th>
                                                <th>'.$lang['CONTRACT_END'].'</th>
                                                <th>'.$lang['SETTINGS'].'</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        foreach($suppliers as $k => $u){
                                            echo'<tr id=tr_'.$u['suppliers_sn'].'>
                                                
                                                <td>
                                                    '.$u['suppliers_name'].'
                                                </td>
                                                <td>'
                                                    .get_data("supply_type","supply_type_name","supply_type_sn",$u['suppliers_supply_id']).
                                                '</td>
                                                <td>'
                                                    .get_data("users","users_name","users_sn",$u['suppliers_accountable_id']).
                                                '</td>
                                               
                                                <td>'
                                                    .$u['suppliers_city'].
                                                '</td>  
                                                <td>'
                                                    .$u['suppliers_phone'].
                                                '</td>
                                                <td>'
                                                    .$u['suppliers_email'].
                                                '</td>  
                                                <td>'
                                                    ._date_format($u['suppliers_contract_end']).
                                                '</td>
                                                <td>';
                                                if($group['contacts_edit'] == 1)
                                                {
                                                   echo '<a href="./edit_supplier.php?id='.$u['suppliers_sn'].'"><i class="far fa-edit darkish-green"></i></a>';
                                                }
                                                if($group['contacts_delete'] == 1)
                                                {

                                                    echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Delete_'.$u['suppliers_sn'].'"></i>';
                                                }
                                                echo '</td>
                                                </tr>
                                                <!-- confirm delete Modal -->
                                                <div class="modal fade addModal" id="Delete_'.$u['suppliers_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                                        <div class="modal-content dark_bg">

                                                            <div class="modal-body">
                                                                <h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
                                                            </div>
                                                            <div class="modal-footer" id="item_'.$k.'">
                                                                <button type="button" class="btn _btn btn-light" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
                                                                <button type="button" id="item_'.$u['suppliers_sn'].'" class="btn _btn btn-danger rose-bg  delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
                                                            </div>
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

<!--                            </div>-->

<!--                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>