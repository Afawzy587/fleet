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
    switch($_GET['do'])
        {
            case"":
            case"login":
				if($login->doCheck() == true)
				{
					header("Location:./index.php");
                    exit;
				}else
				{
                    // recieving the parameters
                   $logResult = $login->doLogin(sanitize($_POST["username"]),sanitize($_POST["password"]),sanitize($_POST["remember"]));

                    if($logResult ==0)
                    {
                        $message = $lang['LGN_EMPTY_DATA'];
                        
                    }elseif($logResult ==1)
                    {
                        $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	"login",
                                    "mode" 		        => 	"login",
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                        $message = $lang['LGN_IS_SUCESSFULLY'];
                        header("Location:./index.php");
                        exit;

                    }elseif($logResult == 2)
                    {
                        $message = $lang['PASSWORD_NOT_CORRECT'];
                        
                    }elseif($logResult == 3){
                        $message = $lang['USER_NOT_FOUND'];
                    }
                    elseif($logResult == 4)
                    {
                        $message = $lang['LGN_IS_DUPLICATED'];
                        header("Location:./index.php");
                        exit;
                    }else
                    {
                        $message = $lang['LGN_WORNG_DATA'];
                    }
				}
            break;
            case"logout":
                if($login->doLogout() == true)
                {
                    $logs->addLog(NULL,
                                array(
                                    "type" 		        => 	"user",
                                    "module" 	        => 	"login",
                                    "mode" 		        => 	"logout",
                                    "id" 	        	=>	$_SESSION['id'],
                                ),"user",$_SESSION['id'],1
                            );
                }else
                {
                    $message = $lang['login_first'];
                }
            break;
        }
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $lang['LOGIN'];?></title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css" integrity="sha384-Jt6Tol1A2P9JBesGeCxNrxkmRFSjWCBW1Af7CSQSKsfMVQCqnUVWhZzG0puJMCK6" crossorigin="anonymous">
<link rel="stylesheet" href="./assets/css/login.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 registration sidebar">
                <div class="sidebar-sticky">
                    <h1 class="h3 centered"><?php echo $lang['LOGIN_HEADER'];?></h1>
                    <p class="centered gray_text"><?php echo $lang['LOGIN_HEADER_p'];?></p>
                    <form class="needs-validation login-form" action="login.php?do=login" method="post" novalidate>
                        <?php
                        if($message)
                        {
                            echo '<div class="alert alert-danger faildlogin_msg" role="alert">'.$message.'</div>';
                        }?>
                        <div class="form-group mb-5">
                            <input type="username" class="form-control" name="username" id="username" autocomplete="new-password" placeholder="<?php echo $lang['USERNAME'];?>" required>
                            <div class="invalid-feedback">
                                <?php echo $lang['INSERT_USERNAME'];?>
                            </div>
                        </div>
                        <div class="form-group mb-5">
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" placeholder="<?php echo $lang['PASSWORD'];?>" required  minlength="8">
                            <div class="invalid-feedback">
                                <?php echo $lang['CHECK_PASSWORD'];?>
                            </div>
                        </div>
                        <div class="custom-control custom-checkbox mb-5">
                            <span>
                                <input type="checkbox" class="custom-control-input" name="remember" id="customCheck" name="example1" value="1">
                                <label class="custom-control-label" for="customCheck"><?php echo $lang['REMEMBER'];?></label>
                            </span>
                            <span class="left">
                                <a href="recovery_password.php"><?php echo $lang['FORGET_PASSORD'];?> </a>
                            </span>
                        </div>

                        <div class="form-group mt-3 centered">
                            <button class="btn" type="submit"><?php echo $lang['LOG_IN'];?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6 side-bg">
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.rtlcss.com/bootstrap/v4.1.3/js/bootstrap.min.js" integrity="sha384-C/pvytx0t5v9BEbkMlBAGSPnI1TQU1IrTJ6DJbC8GBHqdMnChcb6U4xg4uRkIQCV" crossorigin="anonymous"></script>
<script>
        $(function()
        {
          $('.side-bg').css({ height: $(window).innerHeight() });
          $(window).resize(function(){
            $('.side-bg').css({ height: $(window).innerHeight() });
          });
        });

        $(function ()
        {
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
        });
    </script>
</body>
</html>