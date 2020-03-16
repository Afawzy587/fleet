<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-car_fuel.php");
	$car_fuel = new systemcar_fuel();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['car_fuel_list'] == 0){
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
                $total       = $car_fuel->getTotalcar_fuel($from,$to);
                $pager->doAnalysisPager("page",$page,$basicLimit,$total,"fuel.php?to=".$to."&from=".$from.$paginationAddons,$paginationDialm);
                $thispage    = $pager->getPage();
                $limitmequry = " LIMIT ".($thispage-1) * $basicLimit .",". $basicLimit;
                $pager       = $pager->getAnalysis();
                $_car_fuel   = $car_fuel->getsitecar_fuel($limitmequry,$from,$to);
                $total_cost  = $car_fuel->getsum($from,$to,"car_fuel_cost");
                $total_liter = $car_fuel->getsum($from,$to,"car_fuel_amount");
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"car_fuel",
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
            <span class="page_titles">
                <h1 class="h2"><?php echo $lang['FUEL'];?></h1>
            </span>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <button class="btn dark_btn">
                        <a href="./add_fuel.php"><?php echo $lang['ADD_CAR_FUEL'];?></a>
                    </button>
                </div>
            </div>

        </div>
        <div class="container page_body">
           <input type="hidden" value="car_fuel" id="table">
            <input type="hidden" value="job_orders_delete" id="permission">
            <div class="row">
                <div class="col">
                    <div class="row ">
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
                        <div class="col-md-7 mt-3 flex_items">
                            <span class="mr-2">
                                <?php echo $lang['DATE_FROM'];?>
                            </span>
                            <span>
                                <input id="datepicker1" width="100%" required name="startdate1" onchange="changeTableFromdate(this, 'fuel_table')" value="<?php echo _date_format($from);?>" />
                            </span>
                            <span class="m-3">
                                <?php echo $lang['DATE_TO'];?>
                            </span>
                            <span>
                                <input id="datepicker2" width="100%" required name="enddate" onchange="changeTableTodate(this, 'fuel_table')" value="<?php echo _date_format($to);?>"/>
                            </span>

                        </div>
                        <div class="col-md-2 mt-3">
                            <?php
                            if($group['car_fuel_cost'] == 1){
                                echo '<p class="bold">'.$lang['TOTAL_SERVICE_ORDER'].'<span>'.$total_cost.' '.$lang['CURRENCY'].'</span></p>';
                            }
                            if($group['car_fuel_amount'] == 1){
                                echo '<p class="bold">'.$lang['TOTAL_SERVICE_LITER'].'<span>'.$total_liter.' '.$lang['LITER'].'</span></p>';
                            }
                            
                            ?>
                        </div>
                    </div>
                    <table class="table  white-bg fuel_table searchTable" id="result">
                       <?php  if(empty($_car_fuel))
							{
								echo "<tr><th colspan=\"5\">".$lang['NO_CAR_FUEL']."</th></tr>";
							}else{
								echo'
								<thead>
									<tr>
										<th></th>
										<th>'.$lang['CAR'].'</th>
										<th> '.$lang['PREVIOUS_READ'].'</th>
										<th> '.$lang['NOW_READ'].'</th>
										<th> '.$lang['DEFERENCE'].'</th>
										<th> '.$lang['EXPECT_LITER'].'</th>
										<th> '.$lang['SYS_FUEL_TYPE'].'</th>
										<th> '.$lang['LITER_C'].'</th>
										<th> '.$lang['LITER_COST'].'</th>
										<th> '.$lang['FOR_K_M'].'</th>
										<th></th>
									</tr>
								</thead>
								<tbody>';
								foreach($_car_fuel as $k => $u){
									echo '<tr class="tr_collapse" data-toggle="collapse" data-target=".order_'.($k).'">
											<td colspan="4">
												<p class="small_title">'.day_name($u['date'] , 'D').' : '._date_format($u['date']).' '.'<i class="fa fa-arrow-down"></i></p>
											</td>
											<td>
												<p class="bold mb-0">'.($u['now'] - $u['previous']).'</p>
											</td>
											<td>
												<p class="bold dodger-blue mb-0">127.25</p>
												<p class="bold dodger-blue  mb-0">860</p>
											</td>
											<td></td>
											<td>'.$u['amount'].'</td>
											<td>
												<p class="mb-0">'.$u['cost'].'<i class="fas fa-circle danger_status ml-5"></i></p>
											</td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									';
									get_day_fuel($u['date'],($k));
								}
	
	
							}?>
                        
                            
                            

                        <tbody>
                    </table>
                    <!--		Start Pagination -->
                    <div class='pull-left pagination-container'>
                        <nav>
                            <ul class="pagination">
                                <!--	Here the JS Function Will Add the Rows -->
                            </ul>
                        </nav>
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
       url:"search.php?do=fuel",
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
