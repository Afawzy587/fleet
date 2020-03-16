<?php 
     if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");

    include("./inc/Classes/system-expenses.php");
	$expenses = new systemexpenses();
     
	if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
            if($group['expenses_add'] == 0){
                header("Location:./permission.php");
                exit;
            }else
            {
                $expenses       = $expenses->getsiteexpenses();
                $logs->addLog(NULL,
                        array(
                            "type" 		        => 	"admin",
                            "module" 	        => 	"expenses",
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
       <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
            <span class="page_titles">
                <h1 class="h2">  <?php echo $lang['CARS'];?></h1>
                <h4 class="sub_title">
                    <strong> &gt; </strong> <?php echo $lang['EXPENSES_TYPES'];?></h4>
            </span>
        </div>
        <div class="container page_body">
            <p class="small_title"><?php echo $lang['ANOTHER_EXPENSES_TYPES']?></p>
            <div class="container page_body">
                    <div class="row white-bg form2">
                        <div class="col">
                            <div class="row bottom_border">
                                <h5 class="dodger-blue "><?php echo $lang['EXPENSES_TYPE'];?></h5>
                            </div>
                            <div class="row">
                               <?php foreach($expenses as $k => $v)
									{
										echo'<div class="col-md-4 bottom_border expenses_type_item">
												<span>
													<h5 class="bold_text">'.$v['expenses_name'].'</h5>
												</span>
												<span>';
													if($group['expenses_edit'] == 1)
													{
														echo '<i class="far fa-edit darkish-green" data-toggle="modal" data-target="#Edit'.$v['expenses_sn'].'"></i>';
													}
													if($group['expenses_delete'] == 1)
													{
														echo '<i class="fas fa-trash rose" data-toggle="modal" data-target="#Deleteconfirmation_'.$v['expenses_sn'].'"></i>';
													}
											echo'</span>
											</div>
											    <!-- Edit Modal -->
											<div class="modal fade addModal " id="Edit'.$v['expenses_sn'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered " role="document">
													<div class="modal-content">
														<div class="modal-header">
															'.$lang['EDIT_EXPENSES_TYPE'].'
														</div>
														<div class="modal-body ">
															<form class="company_form  needs-validation" novalidate>
																	<div class="input-group">
																		<label for="exampleInputEmail1">'.$lang['EXPENSES_TYPE'].'</label>
																		<div>
																			<input type="text" class="form-control searchInput" id="myInput_'.$v['expenses_sn'].'" placeholder="'.$lang['EXPENSES_TYPE'].'" value="'.$v['expenses_name'].'" required>
																				<div class="invalid-feedback">
																					'.$lang['PLEASE_INSERT_EXPENSES'].'
																				</div>
																		</div>
																	</div>
																</div>
																<div class="modal-footer">
																	<button id="'.$v['expenses_sn'].'" class="edit_expenses btn btn-success _btn darkish-green-bg ml-3" type="submit" >'.$lang['SAVE'].'</button>
																	<a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal">'.$lang['CANCEL'].'</a>

																</div>
															</form>
													  </div>
												</div>
											</div>
											    <!-- confirm delete Modal -->
											<div class="modal fade addModal" id="Deleteconfirmation_'.$v['expenses_sn'].'" tabindex="-1" role="dialog"
												aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered " role="document">
													<div class="modal-content dark_bg">

														<div class="modal-body">
															<h5 class="white_text center">'.$lang['CONFORM_DELETE'].'</h5>
														</div>
														<div class="modal-footer">
															<button type="button" class="delete_expenses btn _btn btn-light" id='.$v['expenses_sn'].' data-dismiss="modal">'.$lang['CONFORM'].'</button>
															<button type="button" class="btn _btn btn-danger rose-bg delete_confirmation_btn" data-dismiss="modal">'.$lang['SYS_CANCEL'].'</button>
														</div>
													</div>
												</div>
											</div>
											';
									}
								?>
                                <div class="col-md-4 bottom_border expenses_type_item">
                                    <p class="add_item pale-teal" data-toggle="modal" data-target="#AddModalCenter"><i class="fas fa-plus-circle darkish-green"></i><?php echo $lang['ADD_NEW_EXPENCES'];?></p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
            </div>
        </div>
    </main>
    <!-- Add Modal -->
    <div class="modal fade addModal " id="AddModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <?php echo $lang['ADD_EXPENSES_TYPE'];?> 
                </div>
                <div class="modal-body ">
                    <form class="company_form  needs-validation" novalidate>
                        <div class="input-group">
                            <label for="exampleInputEmail1"><?php echo $lang['EXPENSES_TYPE'];?></label>
                            <div>
                                <input type="text" class="form-control searchInput" id="myInput" required aria-label="Text input with segmented dropdown button" placeholder="<?php echo $lang['EXPENSES_TYPE'];?>">
                                    <div class="invalid-feedback">
                                        <?php echo $lang['PLEASE_INSERT_EXPENSES'];?>
                                    </div>
                            </div>
                        </div>
						<div class="modal-footer">
							<button class="add_expenses btn btn-success _btn darkish-green-bg ml-3" type="submit"><?php echo $lang['SAVE'];?></button>
							<a class="btn _btn btn-danger rose-bg ml-3" data-dismiss="modal" href=""><?php echo $lang['CANCEL'];?></a>
						</div>
                	</form>
            	</div>
        	</div>
    	</div>
    </div>

    
<?php include './assets/layout/footer.php';?>