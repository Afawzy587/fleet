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
    if($login->doCheck() == true)
    {
        header("Location:./index.php");
        exit;
    }else
    {
        if($_POST)
        {
             $email = sanitize($_POST['email']);
            if($email != "")
            {
                $user_id = $login->checkmailisfound($email);
                if($user_id != 0)
                {
                   $send  = sendemail($email,$user_id);
                }
                
            }else{
                header("Location:./error/index.php");
                exit;
            }
             
        }

    }
        
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $lang['LGN_FORGOT'];?></title>
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css" integrity="sha384-Jt6Tol1A2P9JBesGeCxNrxkmRFSjWCBW1Af7CSQSKsfMVQCqnUVWhZzG0puJMCK6" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/forgetpassword.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 registration sidebar">
                <div class="sidebar-sticky">
                    
                   <?php
                    if($send == 1)
                    {
                        echo '<h1 class="h3 centered">'.$lang['SEND_PASSWORD_MESSAGE'].'</h1>' ;
                    }elseif($user_id =="send"){
                        echo '<h1 class="h3 centered">'.$lang['SEND_PASSWORD_MESSAGE_BEFORE'].'</h1>' ;
                    }
                    else{
                    echo'<h1 class="h3 centered">'.$lang['LOGIN_HEADER'].'</h1>
                    <p class="centered gray_text">'.$lang['LGN_SEND_REQ_PASS'].'</p>
                        <form class="needs-validation login-form" method="post" action="recovery_password.php" novalidate>
                            <div class="form-group mb-5">
                                <input type="email" name="email" class="form-control" id="email" placeholder="'.$lang['EMAIL'].'" required>
                                <div class="invalid-feedback">
                                    '.$lang['REC_INVALID_MESSAGE'].'
                                </div>
                            </div>
                            <div class="form-group mt-3 centered">
                                <button class="btn" type="submit">
                                    '.$lang['REC_SUBMIT'].'
                                </button>
                            </div>
                        </form>';
                    }
                    ?>
                    
                </div>
            </div>
            <div class="col-md-6 side-bg">
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>

    <script src="https://cdn.rtlcss.com/bootstrap/v4.1.3/js/bootstrap.min.js"
        integrity="sha384-C/pvytx0t5v9BEbkMlBAGSPnI1TQU1IrTJ6DJbC8GBHqdMnChcb6U4xg4uRkIQCV"
        crossorigin="anonymous"></script>
    <script>
        $(function(){
          $('.side-bg').css({ height: $(window).innerHeight() });
          $(window).resize(function(){
            $('.side-bg').css({ height: $(window).innerHeight() });
          });
        });

        $(function () {
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