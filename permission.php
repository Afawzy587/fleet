<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	// output buffer..
	ob_start("ob_gzhandler");
    // my system key cheker..
    define("inside",true);
	// get funcamental file which contain config and template files,settings.
	include("./inc/fundamentals.php");
    include './assets/layout/header.php';
    if($login->doCheck() == false)
	{
        header("Location:./login.php");
        exit;
	}else{
        $logs->addLog(NULL,
                    array(
                        "type" 		        => 	"admin",
                        "module" 	        => 	"permission",
                        "mode" 		        => 	"view",
                        "id" 	        	=>	$_SESSION['id'],
                    ),"admin",$_SESSION['id'],1
                );
    }
    
    
?>
<?php include './assets/layout/navbar.php';?>
<main class="">
    <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <span class="page_titles">
            <h1 class="h2"><?php echo $lang['PERMISSION_ERROR'];?> </h1>
        </span>
    </div>
    <div class="container page_body">
        <div class="row">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> <?php echo $lang['PERMISSION_ERROR_CONTENT']?></h3>
            </div>
        </div>
    </div>
</main>

 <?php include './assets/layout/footer.php';?>
