<!DOCTYPE html>
<html lang="en">

<head>

    <?php 
        require_once("./includes/head.php");
    ?>

    <title>LIFE - Contact</title>

    <script src="./plugins/jquery.validate.js"></script>
    <script src="./js/contact-form-validation.js"></script>
    
</head>

<body>

    <?php
        require_once("./includes/header.php");

        
        if (isLoggedIn()) {
            echo "<main class='main-general'>";
            require_once("./includes/nav.php");

        } else {
            echo "<main class='main-general-no-nav'>";
            
        }

    ?>

    <noscript>Please enable JavaScript for this page to function properly.</noscript>
    <div class="contact-panel">
        <div class="contact-info-panel">
            <h2>Get in touch with us!</h2>
            <p>Call us at <a href="tel:+6192345678"><u>03 9234 5678</u></a> 9am to 4pm weekdays<br>or send us a
                message below.</p>
        </div>
        <div class="form-container">
            <form method="GET" action="./submitted.php" class="contact-form center-content" id="contact-form" name="contact-form">
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Full name">
                <label for="contact_details"></label>
                <input type="text" name="contact_details" id="contact_details" placeholder="Email/Phone Number">
                <label for="message"></label>
                <textarea name="message" id="message" placeholder="What's the message?"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
        <div class="address-panel">
            <img src="./assets/icons/logo-crop_adobe_express.svg" alt="LIFE Logo">
            <p>Level 2 235 Random Road,<br>Melbourne, VIC 3000 <br>Australia</p>
            <p><a href="tel:+6192345678">03 9234 5678</a></p>
            <p><a href="mailto:contact@life.com.au">contact@life.com.au</a></p>
        </div>
    </div>

    <?php 
        echo "</main>";
        require_once("./includes/footer.php");
    ?>

</body>

</html>