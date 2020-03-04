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
    include("./inc/Classes/system-company_informtion.php");
	$informations = new system_informations();

    if($login->doCheck() == false)
    {
        header("Location:./login.php");
        exit;
    }else{
        switch($_GET['do'])
		{
			case"":
			case"list":
                $company       = $informations->getsiteinformation();
                $departments   = $informations->getdatatable("departments");                                           // departments
                $managements   = $informations->getdatatable("management");                                            // management
                $car_status    = $informations->getdatatable("car_status");                                            // car_status
                $car_owner     = $informations->getdatatable("car_owner");                                             // car_owner
                $transfer_type = $informations->getdatatable("transfer_type");                                         // transfer_type
                $fuel_type     = $informations->getdatatable("fuel_type");                                             // fuel_type
                $wheel_size    = $informations->getdatatable("wheel_size");                                            // wheel_size
                $supply_type   = $informations->getdatatable("supply_type");                                          // supply_type
                $job_type      = $informations->getdatatable("job_type");                                             // job_type
                $logs->addLog(4,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	"system_information",
                                    "mode" 		        => 	"view",
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
            break;
            case"add_information":
                if($_POST)
                {
                    $u       = $informations->getsiteinformation();
                    $company['name']        = sanitize($_post['name']);
                    $company['address']     = sanitize($_post['address']);
                    $company['phone']       = sanitize($_post['phone']);
                    $logs->addLog(5,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	"system_information",
                                    "mode" 		        => 	"edit_company_information",
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                    exit;
                }
            break;
        }
    }
    include './assets/layout/header.php';

?>
<style>
        body {
            background-color: #e4e4e4;
        }

        .sidenav .nav-item {
            background: #a3a0fb;
            margin: 2px;
            color: aliceblue !important;
        }

        .sidenav li.nav-item i {
            padding-left: 0.5rem;
        }

        #navAccordion.sidenav .nav-link {
            padding: 0.8rem 1rem;
            color: #d1d0fd;
        }

        #navAccordion.sidenav .nav-item.active {
            background-color: #43425d;
        }

        #navAccordion.sidenav .nav-item.active .nav-link {
            color: #fff;
        }

        .navbar {
            padding: 1rem 1.2rem 1rem 4.5rem;
        }

        .navbar-brand {
            margin-left: 0;
        }

        .top_nav img {
            padding: 0.4rem;
        }

        .navbar-collapse .form-inline i {
            margin: 0 12px;
        }

        .cool-grey {
            font-size: 1.2rem;
            color: #a4afb7;
        }

        hr {
            border: none;
            border-left: 1.5px solid #e5eaea;
            height: 62px;
            width: 1px;
            margin: 0 10px;
            color: #ececf3;
        }

        .lightgray {
            color: #babbbb;
        }

        a.dropdown-toggle,
        a.dropdown-toggle::after {
            color: #43425d;
        }

        main {
            margin-right: 0 !important;
        }

        .page_title {
            background-color: rgb(59, 134, 255);
            padding: 1.777rem;
            color: #fff;
            margin-top: 1.4rem;
        }

        .btn {
            padding: 0.5rem 1.25rem;
        }

        .dark_btn {
            background-color: #43425d;
            color: #fff;
        }

        .page_content {
            margin-left: 1.6rem;
        }

        .page_body {
            padding-right: 0.5rem;
        }

        .page_body .col-md-4,
        .col {
            padding-right: 0;
            /* padding: 0.5rem;
            margin: 0 0.444rem; */
        }

        .page_body.container {
            max-width: 100%;
        }

        .page_body .row {
            margin-right: 0;
        }

        .white-bg {
            background-color: #fff;
            padding: 1rem;
            box-shadow: 0 3px 6px 0 rgba(0, 0, 0, 0.16);
        }

        @media (min-width: 992px) {
            main {
                margin-right: 240px !important;
            }

            .page_body {
                padding-right: 0;
            }
        }

        .small_title {
            color: #43425d;
            font-size: 15px;
            font-weight: bold;
            line-height: 3;
            margin-top: 0.6rem;
        }

        .company_form label,
        .upload-btn-wrapper label {
            width: 20%;
            color: #43425d;
        }

        .company_form input {
            display: inline-block;
            width: 77%;
            height: calc(1.5rem + 2px);
        }

        .company_form .form-group {
            margin-bottom: 1rem;
            line-height: 2rem;
        }

        .company_form.company_info .form-group {
            margin-bottom: 0.9rem;
        }

        .dark_btn {
            background-color: #43425d;
        }

        .add_item {
            cursor: pointer;
            margin-top: 1.5rem;
            margin-bottom: 0.5rem;
            width: fit-content;
        }

        .add_item i {
            margin-left: 0.5rem;
        }

        .page_body .btn.xs_btn {
            padding: 0rem 0.5rem;
            background: #3b86ff;
            color: #fff;
            border-radius: 4px;
            border: solid 1px #e8e9ec;
        }

        .form-control {
            border: 1px solid #e8e9ec;
        }

        .form2 {
            display: flex;
            justify-content: space-between;
        }

        .form2 label {
            margin-bottom: 0;
            width: 35%;
        }

        .form2 .input-group {
            display: inline-flex;
            align-items: baseline;
            width: 80%;
        }

        .form2 select {
            width: 65%;
        }

        .form2 .list_actions {
            display: inline-flex;
        }

        .form2 .form-control {
            border-radius: .25rem !important;
            margin-left: 0.1rem;
        }

        .form2 i {
            margin: 0.3rem;
        }

        input::placeholder {
            color: #e4e4e4;
            font-size: 12px;
        }

        .form2 .input-group-append {
            position: relative;
        }

        .form2 .dropdown-menu.show {
            transform: translate3d(32px, 25px, 0px) !important;
        }

        .form2 .dropdown-menu {
            min-width: 11.4rem;
        }

        .modal-title {
            color: #fff;
        }

        .modal-body {
            color: #fff;
        }

        .modal-body label {
            width: 20%;
        }

        .addModal .modal-body input {
            display: inline-block;
            width: auto;
        }

        ._btn {
            padding: 0.3rem 2.5rem;
            border: none;
        }

        .modal-footer {
            justify-content: center;
            border: none;
        }

        .modal-footer>:not(:last-child) {
            margin-left: 1.25rem;
        }

        .modal-footer,
        .modal-body {
            padding: 1.3rem;
        }

        .DeleteModal .list-group-item {
            background-color: transparent;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid rgba(247, 247, 247, 0.22);
        }

        /* upload button */

        .upload-btn-wrapper {
            position: relative;
            /* overflow: hidden; */
            display: inline-block;
        }

        .upload-btn-wrapper button {
            color: #fff;
            color: #fff;
            padding: 0.1rem 2rem;
            font-size: smaller;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        /* bootstrap select */

        .bootstrap-select .dropdown-toggle .filter-option {
            text-align: right;
        }
    </style>
<?php include './assets/layout/navbar.php';?>
<main class="">
    <div class="page_title d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom">
        <span class="page_titles">
            <h1 class="h2"><?php echo $lang['system_information'];?> </h1>
        </span>
    </div>
    <div class="container page_body">
            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col">
                            <h4 class="small_title"><?php echo $lang['SYS_COMPANY']; ?></h4>
                            <div class="white-bg" id="company_information">
                                <form class="company_form" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label><?php echo $lang['SYS_NAME']; ?></label>
                                        <input type="text" class="form-control" id="exampleInputEmail1" maxlength="125" name="name" value="<?php echo $company['company_information_name'];?>" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['SYS_ADDRESS']; ?></label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $company['company_information_address'];?>" id="address">
                                    </div>
                                    <div class="form-group">
                                        <label><?php echo $lang['SYS_PHONE']; ?></label>
                                        <input type="text" class="form-control" id="phonenumber" name="phone" id="phone" value="<?php echo $company['company_information_phone'];?>">
                                    </div>
                                    <a type="submit" class="add_information btn btn-success _btn darkish-green-bg" ><?php echo $lang['SYS_SAVE']; ?></a>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="row" id="company_logo">
                        <div class="col">
                            <div class="white-bg upload_logo">
                                <form action="" class="logo_form" method="post" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <label class="logo-label"><?php echo $lang['SYS_LOGO']; ?></label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="file" id="file"
                                                aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile02"><?php echo $lang['SYS_INSERT_UPLOAD']; ?></label>
                                        </div>
                                        <div class="input-group-prepend">
                                            <span class="input-group-text darkish-green-bg _btn btn" id="but_upload"><?php echo $lang['SYS_UPLOAD']; ?></span>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <?php   buliddropmenu($transfer_type,"SYS_TRANSFER","transfer_type");?>
                </div>
                <div class="col-md-4">
                  <?php   buliddropmenu($departments,"SYS_DEPATMENT","departments");?>
                  <?php   buliddropmenu($car_status,"SYS_CAR_STATUS","car_status");?>
                  <?php   buliddropmenu($fuel_type,"SYS_FUEL_TYPE","fuel_type");?>
                </div>
                <div class="col-md-4">
                  <?php   buliddropmenu($managements,"SYS_MANAGEMENT","management");?>
                  <?php   buliddropmenu($car_owner,"SYS_CAR_OWNER","car_owner");?>
                  <?php   buliddropmenu($wheel_size,"SYS_WHEEL_SIZE","wheel_size");?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <?php   buliddropmenu($supply_type,"SYS_SUPPLY_TYPE","supply_type");?>
                </div>
                <div class="col-md-4">
                    <?php   buliddropmenu($job_type,"SYS_JOB_TYPE","job_type");?>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
</main>
<?php include './assets/layout/footer.php';?>
<script>


        // live-search-input
        $(document).ready(function () {
            $(".searchInput").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(this).siblings(".input-group-append").children(".dropdown-menu").addClass('show');
                $(this).siblings(".input-group-append").children(".dropdown-menu.show").css('transform', 'translate3d(32px, 25px, 0px)!important');
                $(this).siblings(".input-group-append").children(".dropdown-menu.show").css('top', '0');
                $(this).siblings(".input-group-append").children(".dropdown-menu.show").css('left', '0');
                $(this).siblings(".input-group-append").children(".dropdown-menu").children().filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
            $(".searchInput").on("focusout", function () {
                $(this).siblings(".input-group-append").children(".dropdown-menu").removeClass('show');
                console.log('blurrrr');
            })
        });
    

 </script>
</html>


