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

    if($login->doCheck() == false)
    {
        header("Location:./login.php");
        exit;
    }else{
    }
    include './assets/layout/header.php';

?>
<?php include './assets/layout/navbar.php';?>
<main class="">
    <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <span class="page_titles">
            <h1 class="h2"><?php echo $lang['INDEX_TITLE'];?> </h1>
            <h4 class="sub_title"> <strong> - </strong> <?php echo $lang['INDEX_COMPANY'];?> </h4>
        </span>
    </div>
</main>
<?php include './assets/layout/footer.php';?>


