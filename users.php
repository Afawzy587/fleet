<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-users.php");
	$_users = new systemusers();
     
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
                $total       = $_users->getTotalusers();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"users.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $users       = $_users->getsiteusers($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"users",
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
                            if($group['contacts_add'] == 1)
                            {
                                echo '<button class="btn dark_btn"><a href="./add_user.php">'.$lang['CONT_ADDD_USER'].'</a></button>';
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
                        <div class="tab-content">
                            <input type="hidden" value="users" id="table">
                            <input type="hidden" value="contacts_delete" id="permission">
                            <div class="tab-pane active" id="previousIssue">
                                <div class="input-group input-group-lg search_bar">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-lg">
                                            <i class="fas fa-search"></i>
                                        </span>
                                    </div>
                                    <input class="form-control search_bar" type="search" id="search_text" placeholder="<?php echo $lang['SEARCH'];?>">
                                </div>
                                <table class="table table-class white-bg contacts_table table-hover" id="result">
                                <?php  if(empty($users))
                                    {
                                        echo "<tr><th colspan=\"5\">".$lang['US_NO_USERS']."</th></tr>";
                                    }else{
                                        echo '
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="wide_col">'.$lang['US_NAME'].'</th>
                                                <th>'.$lang['GROUP'].'</th>
                                                <th>'.$lang['JOB'].'</th>
                                                <th>'.$lang['PROJECT'].'</th>
                                                <th>'.$lang['CAR'].'</th>
                                                <th>'.$lang['PHONE'].'</th>
                                                <th>'.$lang['US_LAST_LOGIN'].'</th>
                                                <th>'.$lang['SETTINGS'].'</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                        foreach($users as $k => $u){
                                            echo'<tr id=tr_'.$u['users_sn'].'>
                                                <td class="contact_img">
                                                        <img class="rounded-circle" height="35" src="'.$path.$u['users_photo'].'" alt="profile-pic">
                                                </td>
                                                <td>
                                                    <h6 class="contact_name">'.$u['users_name'].'</h6>
                                                    <h6 class="tangerine">'.$u['users_job_serial'].'</h6>
                                                </td>
                                                <td>'
                                                    .get_data("groups","groups_name","groups_sn",$u['users_group_id']).
                                                '</td>
                                                <td>'
                                                    .get_data("job_type","job_type_name","job_type_sn",$u['users_job_id']).
                                                '</td>
                                                <td>'
                                                    .get_data("projects","projects_name","projects_manger_id",$u['users_sn']).
                                                '</td>
                                                ';
                                                    if(get_data("cars","cars_code","cars_supervisor_id",$u['users_sn']) != $lang['NOT_FOUND'])
                                                    {
                                                       echo'<td class="dodger-blue">
                                                        '.$lang['US_CODE'].get_data("cars","cars_code","cars_supervisor_id",$u['users_sn']).'
                                                        </td>';
                                                    }else{
                                                        echo'<td>
                                                        '.get_data("cars","cars_code","cars_supervisor_id",$u['users_sn']).'
                                                        </td>';
                                                    }
                                                echo'
                                                <td>'
                                                    .$u['users_phone'].
                                                '</td>  
                                                <td>';
                                                    if($u['users_last_login'] == "0000-00-00")
                                                    { 
                                                        echo "00/00/0000";
                                                    }else{
                                                       echo _date_format($u['users_last_login']);
                                                    }
                                                echo'</td>
                                                <td>';
                                                if($group['contacts_edit'] == 1)
                                                {
                                                   echo '<a href="./edit_user.php?id='.$u['users_sn'].'"><i class="far fa-edit darkish-green"></i></a>';
                                                }
                                                if($group['contacts_delete'] == 1)
                                                {

                                                    echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Delete_'.$u['users_sn'].'"></i>';
                                                }
                                                echo '
                                                </td>
                                                </tr>
                                                <!-- confirm delete Modal -->
                                                <div class="modal fade addModal" id="Delete_'.$u['users_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered " role="document">
                                                        <div class="modal-content dark_bg">

                                                            <div class="modal-body">
                                                                <h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
                                                            </div>
                                                            <div class="modal-footer" id="item_'.$k.'">
                                                                <button type="button" id="item_'.$u['users_sn'].'" class="btn _btn btn-danger rose-bg  delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
                                                                <button type="button" class="btn _btn btn-light" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <tbody>
                                            ';
                                            
                                        }
                                    }
                                    ?>    
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
<?php include './assets/layout/footer.php';?>
<script>
$(document).ready(function(){
 $('#search_text').keyup(function(){
  var query = $(this).val();
  if(query != '')
  {
       $.ajax({
       url:"search.php?do=users",
       method:"POST",
       data:{query:query},
       success:function(data)
       {
            $('#result').html(data);
       }
      });
  }
 });
});
</script>