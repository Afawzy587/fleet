<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
    <a class="navbar-brand" href="./index.php">
        <img src="<?php echo $path.$company['company_information_photo'];?>" alt="logo" srcset="" height="50">
    </a>
    <hr class="logo_hr">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto sidenav" id="navAccordion">
            <li class="nav-item <?php if($page_name == "index"){echo "active";}?>">
                <a class="nav-link" href="./index.php">
                    <i class="fas fa-chart-bar"></i>
                    <?php echo $lang['DASHBOARD'];?>
                </a>
            </li>
            <?php
            if($group['cars_list'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "cars" || $page_name == "add_car"|| $page_name == "car_order"|| $page_name == "add_expenses"){echo "active";}echo '">
                    <a class="nav-link" href="./cars.php"><i class="fas fa-bus"></i>
                    '.$lang['CARS'].'
                    </a>
                  </li>';
            }
            ?>
            
            <?php
            if($group['check_list'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "damages" || $page_name == "car_damage" ){echo "active";}echo '">
                    <a class="nav-link" href="./damages.php"><i class="fas fa-exclamation-circle"></i>
                    '.$lang['CHECKS'].'
                    </a>
                  </li>';
            }
            ?>
            <?php
            if($group['reminders_list'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "reminders" || $page_name == "reminders_doc"|| $page_name == "add_service_reminder"|| $page_name == "add_doc_reminder"){echo "active";}echo '">
                    <a class="nav-link" href="./reminders.php"><i class="fas fa-bell"></i>
                    '.$lang['REMINDERS'].'
                    </a>
                  </li>';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-wrench"></i>
                    خدمات الصيانة
                </a>
            </li>
            <?php
            if($group['car_fuel_list'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "fuel" ){echo "active";}echo '">
                    <a class="nav-link" href="./fuel.php"><i class="fas fa-gas-pump"></i>
                    '.$lang['FUEL'].'
                    </a>
                  </li>';
            }
            ?>
            <?php
            if($group['contacts_list'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "users" ||$page_name == "add_user" ||$page_name == "edit_user" || $page_name == "groups" || $page_name == "suppliers"|| $page_name == "add_supplier"|| $page_name == "edit_supplier"|| $page_name == "privilage"){echo "active";}echo '">
                    <a class="nav-link" href="./users.php"><i class="fas fa-user-friends"></i>
                    '.$lang['CONT_TITLE'].'
                    </a>
                  </li>';
            }
            ?>
            <?php
            if($group['projects_list'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "projects" ||$page_name == "add_project" ||$page_name == "edit_project" ){echo "active";}echo '">
                    <a class="nav-link" href="./projects.php"><i class="fas fa-briefcase"></i>
                    '.$lang['PROJECTS'].'
                    </a>
                  </li>';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-pie"></i>
                    تقارير ومرفقات
                </a>
            </li>
            <?php
            if($group['system_information'] == 1)
            {
               echo'<li class="nav-item ';if($page_name == "system_information" ){echo "active";}echo '">
                    <a class="nav-link" href="./system_information.php"><i class="fas fa-cog"></i>
                    '.$lang['system_information'].'
                    </a>
                  </li>';
            }
            ?>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-info-circle"></i>
                    عن النظام
                </a>
            </li>
        </ul>
        <form class="form-inline ml-auto mt-2 mt-md-0 top_nav">
            <i class="fas fa-bell cool-grey"></i>
            <hr>
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $user_login['users_name'];?>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">الصفحة الشخصية</a>
                <a class="dropdown-item" href="./login.php?do=logout"><?php echo $lang['LGUT_SUBMIT'];?></a>
            </div>
            <img src="<?php echo $path; if($user_login['users_photo']!= ""){echo $user_login['users_photo'];}else{echo $avater_default;}?>" width="60" height="60" class="rounded-circle">
        </form>

    </div>
</nav>

      <!-- End Navbar -->
