<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    $_SESSION['page']  = $basename;
    include("./inc/Classes/system-job_orders.php");
	$job_orders = new systemjob_orders();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['job_orders_list'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
				if($_GET["from"]!=""||$_GET["to"]!="")
				{
					$from 				= 	date('Y-m-d',strtotime($_GET["from"]));
					$to			        = 	date('Y-m-d',strtotime($_GET["to"]));
				}else
				{
					$from 				= 	date('Y-m-01');
					$to			        = 	date('Y-m-01',strtotime('+1 month',strtotime($from)));
				}

				if($to && $from){
					$paginationDialm = 'true';
				 }
				include("./inc/Classes/pager.class.php");
                $page;
                $pager       = new pager();
                $page 		 = intval($_GET['page']);
                $total       = $job_orders->getTotaljob_ordersintime($from,$to);
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"job_orders.php?to=".$to."&from=".$from.$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $_job_orders = $job_orders->getsitejob_ordersIntime($limitmequry,$from,$to);
                $sum_total   = $job_orders->getservicesum($from,$to);
				$logs->addLog(NULL,
						array(
							"type" 		        => 	"admin",
							"module" 	        => 	"job_orders",
							"mode" 		        => 	"list",
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
                <h1 class="h2"> <?php echo $lang['SERVICES'] ;?></h1>
                <h4 class="sub_title">
                    <strong> &gt; </strong>  <?php echo $lang['JOB_ORDERS'] ;?></h4>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
               <div class="btn-group mr-2">
                    <?php
                        if($group['job_orders_add'] == 1){
                            echo '<button class="btn dark_btn"> <a href="./add_job_order.php">'.$lang['ADD_job_order'].'</a></button>';
                        }
                    ?>
                </div>
            </div>

        </div>
        <div class="container page_body">
            <div class="row">
                <div class="col">
                    <ul class="nav nav-tabs" role="tablist" id="myTab">
                        <li <?php if($page_name == "services_list"){echo "class='active'";}?>>
                            <a href="./services_list.php"><?php echo $lang['SERVICE_LIST'];?></a>
                        </li>
                        <li <?php if($page_name == "job_orders"){echo "class='active'";}?>>
                            <a href="./job_orders.php"><?php echo $lang['JOB_ORDERS'];?></a>
                        </li >
                        <li <?php if($page_name == "services"){echo "class='active'";}?>>
                            <a href="services.php"><?php echo $lang['SERVICE_ACTION'];?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="page_body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <input type="hidden" value="job_orders" id="table">
                            <input type="hidden" value="car_fuel_delete" id="permission">
                            <div class="tab-pane active" id="previousIssue">
                                <div class="row flex_items">
                                    <div class="col-md-3">
                                        <div class="input-group input-group-lg search_bar">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-lg">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </div>
                                            <input class="form-control search_bar" type="search" id="search_text" placeholder="<?php echo $lang['SEARCH'];?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6 flex_items">
                                        <span class="mr-2">
                                            <?php echo $lang['DATE_FROM'];?>
                                        </span>
                                        <span>
                                            <input id="datepicker1" width="100%" required name="startdate1" onchange="changeTableFromdate(this, 'work_orders')" value="<?php echo _date_format($from);?>" />
                                        </span>
                                        <span class="m-3">
                                            <?php echo $lang['DATE_TO'];?>
                                        </span>
                                        <span>
                                            <input id="datepicker2" width="100%" required name="enddate" onchange="changeTableTodate(this, 'work_orders')" value="<?php echo _date_format($to);?>" />
                                        </span>

                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                            if($group['job_orders_cost'] == 1 )
                                            {
                                                echo '<p class="bold">'.$lang['TOTAL_COST'].'<span>'.$sum_total.' '.$lang['CURRENCY'].'</span></p>';
                                            }
                                        
                                        ?>
                                        
                                    </div>
                                </div>
                                <table class="table white-bg  table-hover table-responsive-md searchTable" id="result">
                                   <?php  if(empty($_job_orders))
                                    {
                                        echo "<tr><th colspan=\"5\">".$lang['NO_JOB_ORDERS']."</th></tr>";
                                    }else{
										echo'<thead>
												<tr class="periwinkle-blue ">
													<td>'.$lang['JOB_ORDER_NUM'].'</td>
													<td></td>
													<td>'.$lang['CAR'].'</td>
													<td>'.$lang['DATE_IN'].'</td>
													<td>'.$lang['DATE_OUT'].'</td>
													<td>'.$lang['JOB_ORDER_COST'].'</td>
													<td></td>
												</tr>
											</thead>
											<tbody>
                                        ';
										foreach($_job_orders as $k => $u){
											echo'<tr id=tr_'.$u['job_orders_sn'].'>
													<td class="dodger-blue">'.$u['job_orders_sn'].'</td>
													<td class="contact_img">
														<img height="35" src='.$path.get_data('cars','cars_photo','cars_sn',$u['job_orders_car_id']).' alt="bus-pic">
													</td>
													<td>
														'.get_car_datails($u['job_orders_car_id']).'
													</td>
													<td>'._date_format($u['job_orders_date_in']).'</td>
													<td>'._date_format($u['job_orders_date_expect']).'</td>
													<td>'.($u['job_orders_total_fix'] + $u['job_orders_total_price'] - $u['job_orders_discount']+$u['job_orders_extra']).'</td>
													<td>';
													if($group['job_orders_edit'] == 1)
													  {
														  echo '<a href="./job_orders-addWorkOrder.html"><i class="far fa-edit darkish-green"></i></a>';
													  }
													if($group['job_orders_delete'] == 1)
													  {
														  echo '<i class="fas fa-trash rose ml-2" data-toggle="modal" data-target="#Delete_'.$u['job_orders_sn'].'"></i>';
													  }																	  
													echo'</td>
													</tr>
													<!-- confirm delete Modal -->
													<div class="modal fade addModal" id="Delete_'.$u['job_orders_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
														<div class="modal-dialog modal-dialog-centered " role="document">
															<div class="modal-content dark_bg">
																<div class="modal-body">
																	<h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
																</div>
																<div class="modal-footer" id="item_'.$k.'">
																	<button type="button" id="item_'.$u['job_orders_sn'].'" class="btn _btn  btn-light   delete" data-dismiss="modal">'.$lang['CONFORM'].'</button>
																	<button type="button" class="btn _btn btn-danger rose-bg" data-dismiss="modal">'.$lang['CONFORM_CANCEL'].'</button>
																</div>
															</div>
														</div>
													</div>
													';
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
    </main>

<?php include './assets/layout/footer.php';?>
<script>
$(document).ready(function(){
 $('#search_text').keyup(function(){
  var query = $(this).val();
  if(query != '')
  {
       $.ajax({
       url:"search.php?do=job_orders",
       method:"POST",
       data:{query:query},
       success:function(data)
       {
           console.log(data)
            $('#result').html(data);
       }
      });
  }
 });
});
</script>