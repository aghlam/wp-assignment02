
<?php

/**
 * I considered seprating the form validation into another fragment file but since I initially refactored the 
 * form to use php variables within the html, it was easier to just leave it this way. If there was more time 
 * for the assignment then I would have refactored the validation into a seprate function. This file is much
 * longer than I would like it to be.
 */

include_once("./database/db-functions.php");

include_once("./includes/functions.php");

$error_firstName = $error_lastName = $error_email = $error_emailConfirm
    = $error_phone = $error_birthday = $error_password = false;

if (isset($_POST["submit"])) {

    $form_valid = true;

    // First name validation - Starts with capital, max 30 characters and cannot be blank
    if (!preg_match("/^[A-Z][a-zA-Z]{0,29}$/", $_POST["firstName"])) {
        $error_firstName = true;
        $form_valid = false;
    }

    // Last name validation - cannot be blank
    if (!preg_match("/^[a-zA-Z-]{1,30}$/", $_POST["lastName"])) {
        $error_lastName = true;
        $form_valid = false;
    }

    // Email validation - valid email format
    if (!preg_match("/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+$/", $_POST["email"])) {
        $error_email = true;
        $form_valid = false;
    }

    // Confirm email validation - must match with email
    if (!$error_email && $_POST["email"] != $_POST["emailConfirm"]) {
        $error_emailConfirm = true;
        $form_valid = false;
    }

    // Number validation - must be an Asutralian number
    if (!preg_match("/^((\+61|0)?\s?[2|3|4|7|8])?\d{2}\s?\d{2}\s?\d\s?\d{3}$/", $_POST["phone"])) {
        $error_phone = true;
        $form_valid = false;
    }

    // Age validation - must be older than 16
    if (date("Y") - (int)$_POST["birthday"] < 16) {
        $error_birthday = true;
        $form_valid = false;
    }

    // Password validation - Must start with capital, contain underscore or dash, end with a number and minimum 8 characters long
    if (!preg_match("/^[A-Z]((?=.*_)|(?=.*\-))[a-zA-Z0-9_-]{6,}[0-9]$/", $_POST["password"])) {
        $error_password = true;
        $form_valid = false;
    }

    if ($form_valid) {

        $user = [
            "email" => trim($_POST["email"]),
            "firstName" => htmlspecialchars(trim($_POST["firstName"])),
            "lastName" => htmlspecialchars(trim($_POST["lastName"])),
            "phone" => htmlspecialchars(trim($_POST["phone"])),
            "birthday" => $_POST["birthday"],
            "studentStatus" => $_POST["studentStatus"],
            "employmentStatus" => $_POST["employmentStatus"],
            "password" => $_POST["password"]
        ];

        insertUser($user);



        $qs = "?reason=join";

        $url = "./submitted.php" . $qs;

        redirect($url);

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php 
        require_once("./includes/head.php");
    ?>

    <title>LIFE - Join</title>
    
</head>

<body>

    <?php
        require_once("./includes/header.php");
        echo "<main class='main-general-no-nav'>";
        // require_once("./includes/nav.php");
    ?>

    <noscript>Please enable JavaScript for this page to function properly.</noscript>

    <div class="join-panel">
        <h2>Join us to access the full range of services!</h2>

        <form method="POST" class="join-form" id="join-form">
            <label for="firstName">First name

                <!-- Input will echo out value if $_POST value is set -->
                <input type="text" name="firstName" id="firstName" placeholder="First name" value="<?= isset($_POST["firstName"]) ? $_POST["firstName"] : ''; ?>" >

                <?php
                    if ($error_firstName) {
                        echo "<p id='firstName-error-capital' class='error-message'>First name must start with capital.</p>";
                    }
                ?>

            </label>
            <label for="lastName">Last name
                <input type="text" name="lastName" id="lastName" placeholder="Last name" value="<?= isset($_POST["lastName"]) ? $_POST["lastName"] : ''; ?>">

                <?php
                    if ($error_lastName) {
                        echo "<p id='lastName-error-empty' class='error-message'>Cannot be blank.</p>";
                    }
                ?>

            </label>
            <label for="email">Email
                <input type="text" name="email" id="email" placeholder="Email" value="<?= isset($_POST["email"]) ? $_POST["email"] : ''; ?>">

                <?php
                    if ($error_email) {
                        echo "<p id='email-error' class='error-message'>Please enter a valid email.</p>";
                    }
                ?>

            </label>
            <label for="emailConfirm">Confirm email
                <input type="text" name="emailConfirm" id="emailConfirm" placeholder="Confirm email" value="<?php echo isset($_POST["emailConfirm"]) ? $_POST["emailConfirm"] : ''; ?>">

                <?php
                    if ($error_emailConfirm) {
                        echo "<p id='email-confirm-error' class='error-message'>Please enter a matching email.</p>";
                    }
                ?>

            </label>
            <label for="phone">Phone
                <input type="tel" name="phone" id="phone" placeholder="Phone number" value="<?php echo isset($_POST["phone"]) ? $_POST["phone"] : ''; ?>">

                <?php
                    if ($error_phone) {
                        echo "<p id='phone-error' class='error-message'>Please enter a valid Australian number</p>";
                    }
                ?>

            </label>
            <label class="birthday-label" for="birthday">Birth Year
                <select name="birthday" id="birthday" class="birthday-select">

                    <?php
                        for ($year = 2023; $year >= 1913; $year--) {
                            echo "<option value='$year'";

                            // Matches the year set by $_POST["birthday"]
                            if (isset($_POST["birthday"]) && $_POST["birthday"] == $year) {
                                echo " selected";
                            }

                            echo ">$year</option>";
                        }
                    ?>

                </select>

                <?php
                    if ($error_birthday) {
                        echo "<p id='birthday-error' class='error-message'>You must be 16 or older to join.</p>";
                    }
                ?>

            </label>
            <div class="join-row-container">
                <label for="studentStatus" class="grid-label">
                    <div class="block-label">Student status</div>
                    <div class="radio-option">
                        <input type="radio" id="studying" name="studentStatus" value="studying"
                            <?php
                                if (!isset($_POST["studentStatus"])) {
                                    echo "checked";
                                } else if ($_POST["studentStatus"] == "studying") {
                                    echo "checked";
                                }
                            ?>
                        >
                        <label for="studying">Studying</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="notStudying" name="studentStatus" value="not studying"
                            <?php 
                                if (isset($_POST["studentStatus"]) && $_POST["studentStatus"] == "not studying") {
                                    echo "checked";
                                }
                            ?>
                        >
                        <label for="notStudying">Not studying</label>
                    </div>
                </label>
            </div>
            <div class="join-row-container">
                <label for="employmentStatus" class="grid-label">
                    <div class="block-label">Employment Status</div>
                    <div class="radio-option">
                        <input type="radio" id="employed" name="employmentStatus" value="employed"
                            <?php
                                if (!isset($_POST["employmentStatus"])) {
                                    echo "checked";
                                } else if ($_POST["employmentStatus"] == "employed") {
                                    echo "checked";
                                }
                            ?>
                        >
                        <label for="employed">Employed</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="seeking" name="employmentStatus" value="seeking"
                            <?php 
                                if (isset($_POST["employmentStatus"]) && $_POST["employmentStatus"] == "seeking") {
                                    echo "checked";
                                }
                            ?>
                        >
                        <label for="seeking">Seeking</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="other" name="employmentStatus" value="other"
                        <?php 
                            if (isset($_POST["employmentStatus"]) && $_POST["employmentStatus"] == "other") {
                                echo "checked";
                            }
                        ?>
                        >
                        <label for="other">Other</label>
                    </div>
                </label>
            </div>
            <div class="join-row-container">
                <label class="password-label" for="password">Password
                    <input type="password" id="password" name="password" placeholder="Password">

                    <?php
                        if ($error_password) {
                            echo "<p id='password-error' class='error-message'>Min. 8 characters, starts with a capital, include a dash or underscore, and end with a number.</p>";
                        }
                    ?>

                </label>
            </div>
            <button type="submit" name="submit" class="join-button">Join!</button>
        </form>
    </div>

    <?php
        echo "</main>";
        require_once("./includes/footer.php");
    ?>

</body>

</html>