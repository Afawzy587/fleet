<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-reminders.php");
	$reminders = new systemreminders();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['reminders_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                include("./inc/Classes/pager.class.php");
                $page;
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $reminders->getTotalreminders_doc();
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"reminders_doc.php".$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $reminders       = $reminders->getsitereminders_doc($limitmequry);
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"user",
                            "module" 	        => 	"reminders_doc",
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
        <div
            class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2"><?php echo $lang['REMINDERS'];?></h1>
                <h4 class="sub_title">
                    <strong> &gt; </strong>  <?php echo $lang['DOCS'];?> </h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <?php
                            if($group['reminders_add'] == 1)
                            {
                                echo '<button class="btn dark_btn"><a href="./add_doc_reminder.php">'.$lang['ADD_REMINDER'].'</a></button>';
                            }
                        ?>
                </div>
            </div>
        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li <?php if($page_name == "reminders"){echo "class='active'";}?>>
                            <a href="./reminders.php"><?php echo $lang['SERVICES'];?></a>
                        </li>
                        <li <?php if($page_name == "reminders_doc"){echo "class='active'";}?>>
                            <a href="./reminders_doc.php"><?php echo $lang['DOCS'];?></a>
                        </li>
                    </ul>


                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="previousIssue">
                                <div class="row flex_items">
                                    <div class="col">
                                        <div class="input-group input-group-lg search_bar">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                            <input class="form-control search_bar" type="search" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="<?php echo $lang['SEARCH'];?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <table class="table white-bg  table-hover table-responsive-md searchTable" id="service_reminders">
                                    <?php  if(empty($reminders))
                                    {
                                        echo "<tr><th colspan=\"5\">".$lang['NO_REMINDERS']."</th></tr>";
                                    }else{
                                        echo'<thead>
                                                <tr class="periwinkle-blue ">
                                                    <td></td>
                                                    <td>'.$lang['CAR'].'</td>
                                                    <td>'.$lang['RENEWS'].'</td>
                                                    <td>'.$lang['NEXT_DO'].'</td>
                                                    <td>'.$lang['KHWON_THAT'].'</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        ';
                                        foreach($reminders as $k => $u){
                                            echo '<tr>
                                                <td class="contact_img">
                                                    <a href="./reminders_view.php?r='.$u['reminders_sn'].'"><img height="35" src="'.$path.get_data('cars','cars_photo','cars_sn',$u['reminders_car_id']).'" alt="bus-pic"></a>
                                                </td>
                                                <td>
                                                    <a href="./reminders_view.php?r='.$u['reminders_sn'].'">
                                                        '.get_car_datails($u['reminders_car_id']).'
                                                    </a>
                                                </td>
                                                <td>'.reminder_doc_number($u['reminders_car_id']).'</td>
                                                <td>
                                                    <span class="danger_status">
                                                        <div>منذ 3 شهور</div>
                                                        <div>منذ 2,000 كم</div>
                                                        <b> لا تعمل </b>
                                                    </span>
                                                </td>
                                                <td>
                                                    <span>';
                                                        foreach(get_reminders_memmbers($u['reminders_sn']) as $k => $v){
                                                            echo '<div>'.$v['users_name'].'</div>';
                                                        }
                                                echo'</span>
                                                </td>
                                            </tr>';
                                        }
                                    }
                                        ?>
                                    <tbody>
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
            </div>
        </div>
    </main>
<?php include './assets/layout/footer.php';?>