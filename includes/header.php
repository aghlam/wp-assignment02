<?php require_once("./includes/functions.php"); ?>

<header class="header">
    <div class="header-left"">
        <a href=" ./index.php"><img class="header-logo" src="./assets/icons/logo-crop_adobe_express.svg" alt="life-header-logo"></a>
        <!-- Logo created using https://www.freelogodesign.org/ -->
    </div>
    <div class="header-right"">
    
    <?php

        $user_firstName = '';

        if (isset($_SESSION[USER_SESSION_KEY]['firstName'])) {

            $user_firstName = $_SESSION[USER_SESSION_KEY]['firstName'];
        }


        if (isLoggedIn()) {
            echo "<p class='lead center-content' style='margin-bottom: 0;'>Welcome " . $user_firstName . "</p>";
            echo "<button type='button' class='btn btn-outline-secondary' onclick=\"document.location='./logout.php'\">Logout</button>";

        } else {
            require_once("./includes/login-modal.php");
    
            echo "<button type='button' class='btn btn-outline-secondary btn-lg' onclick=\"document.location='./join.php'\">Join</button>";
            
        }

    ?>

    </div>

</header>