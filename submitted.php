<?php 

    $reason = "";

    if (isset($_GET["reason"])) {
        $reason = $_GET["reason"];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php require_once("./includes/head.php"); ?>

    <title>LIFE - Submitted</title>

</head>
<body>

    <?php 
        require_once("./includes/header.php");
        echo "<main class='main-general-no-nav'>";
    ?>

    <div class="submitted-panel center-content">
        
        <?php 
            if ($reason == "join") {
                echo "<p class='display-5'>Thank you for your joining!</p>";
            } else if($reason == "login") {
                echo "<p class='display-5 text-danger'>Please sign-in to access services.</p>";
            } else {
                echo "<p class='display-5'>Thank you for your submission!</p>";
            }
        ?>

        <p class="display-6">Click <a href="" data-bs-toggle="modal" data-bs-target="#loginModal"><u>here</u></a> to sign in, or</p>
        <p class="display-6">Click <a href="./index.php"><u>here</u></a> to return to homepage.</p>
    </div>

    <?php 
        echo "</main>";
        require_once("./includes/footer.php");
    ?>
    
</body>
</html>