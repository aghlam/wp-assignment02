<?php 
    // Sourced from WP Lectorial 10
    require_once("./includes/functions.php");

    if (!isLoggedIn()) {
        redirect("./submitted.php?reason=login");
    }

?>