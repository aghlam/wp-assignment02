<?php 
    require_once("./includes/authorise.php");
    require_once("./includes/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    require_once("./includes/head.php");
    ?>

    <title>LIFE - My Services</title>
</head>

<body>

    <?php
        require_once("./includes/header.php");
        echo "<main class='main-general-no-nav'>";
    ?>

    <?php require_once("./includes/services-panel.php"); ?>

    <?php
        echo "</main>";
        require_once("./includes/footer.php");
    ?>

</body>

</html>