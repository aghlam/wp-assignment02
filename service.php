<?php require_once("./includes/authorise.php"); ?>

<?php

    // Functionality initially sourced from WP Lectorial 10 and modified for use

    // Variables
    $service_id = (int)$_GET["service_id"];
    $email = getLoggedUser()["email"];
    $service_instruction = "";
    $errors = [];
    $meal_plan = [];
    $meal_saved = false;
    
    if ($service_id != 4) {
        $service_instruction = getServiceInstruction((int)$_GET["service_id"], $_GET["service-type"]);
        
    } else {

        if (isset($_POST["save-meal-plan"])) {
            $meal_plan = $_SESSION[MEAL_PLAN];
        } else {
            $meal_plan = generateMealPlan($_GET["meal-type"], (int)$_GET["target-calories"], (int)$_GET["number-of-meals"]);
            $_SESSION[MEAL_PLAN] = $meal_plan;
        }
        
    }
    
    // Activity submissions
    if (isset($_POST["activity"])) {
        $errors = recordActivity($service_id, $email, $_GET["service-type"], $_POST);
        
    }
    
    // Meal plan submission
    if (isset($_POST["save-meal-plan"])) {

        recordMealPlan($email, $meal_plan);

        $meal_saved = true;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php 
        require_once("./includes/head.php");
    ?>

    <title>LIFE - <?php
    if($service_id == 1){
        echo "Yoga";
    } else if ($service_id == 2) {
    echo "Meditation";
    } else if ($service_id == 3) {
    echo "Stretching";
    } else if ($service_id == 4) {
    echo "Healthy Habits";
    } else {
        echo "Service";
    }
    ?>
    </title>
</head>
<body>

    <?php 
        require_once("./includes/header.php");
        echo "<main class='main-general-no-nav'>";
    ?>

    <div class="container">

        <?php if($service_id === 1) { ?>

            <div class="row">
                <h1 class="display-2 my-3">Yoga - <?= $_GET["service-type"] ?></h1>
            </div>
            <div class="center-content my-3">
                <video class="service-info-video" controls>
                    <source src="<?= $service_instruction["path"]; ?>" type="video/mp4">
                    <!-- Video sourced from https://www.pexels.com/video/video-of-doing-yoga-on-seashore-3327806/ -->
                    Unable to load video
                </video>
            </div>
            
        <?php } else if ($service_id === 2) { ?>

            <div class="row">
                <h1 class="display-2 my-3">Meditation - <?= $_GET["service-type"] ?></h1>
            </div>
            <?php if ($_GET["service-type"] == "Audio") { ?>

                <div class="center-content my-3">
                    <audio class="service-info-video" controls>
                        <source src="<?= $service_instruction["path"]; ?>" type="audio/mp4">
                        <!-- Audio sourced from https://www.freemindfulness.org/ -->
                        Unable to load audio
                    </audio>
                </div>

            <?php } else { ?>

                <div class="center-content my-3">
                    <video class="service-info-video" controls>
                        <source src="<?= $service_instruction["path"]; ?>" type="video/mp4">
                        <!-- Video sourced from https://www.pexels.com/video/a-woman-meditating-8391363/ -->
                        Unable to load video
                    </video>
                </div>

            <?php } ?>

        <?php } else if ($service_id === 3) { ?>

            <div class="row">
                <h1 class="display-2 my-3">Stretching - <?= $_GET["service-type"] ?></h1>
            </div>
            <div class="center-content my-3">
                <video class="service-info-video" controls>
                    <source src="<?= $service_instruction["path"]; ?>" type="video/mp4">
                    <!-- Video sourced from https://www.pexels.com/video/a-man-raised-one-leg-over-a-steel-railing-for-some-stretching-exercise-3195534/ -->
                    Unable to load video
                </video>
            </div>

        <?php } else if ($service_id === 4) { ?>
            
            <div class="container">
                <div class="mt-4 ms-3"><h2 class="display-5"><?= $user_firstName ?>'s personalised meal plan:</h2></div>
                <form method="POST" class="p-0 m-0">

                    <?php $count = 1; foreach($meal_plan as $meal) { ?>
                        <div class="row border border-dark m-5 p-3 rounded-4 justify-content-center">
                            <h2 class="display-5 fs-2">Meal #<?php echo $count; $count++?></h2>
                            <div class="col-4 border-end text-end">
                                <h4 class="display-6 "><?= $meal["name"] ?></h3>
                            </div>
                            <div class="col-4 ">
                                <h4 class="display-6 fs-3">Nutrition Information</h4>
                                <p class="fs-4"><?= $meal["meal_type"] ?></p>
                                <p class="fs-4"><?= $meal["calories"] ?> Calories</p>
                            </div>
                            <div class="col-4 text-start">
                                <img class="img-fluid img-thumbnail mx-auto" style="max-height:270px" src="<?=$meal["image_path"] ?>" alt="">
                                <!-- Images sourced from https://www.eatthismuch.com/ -->
                            </div>
                        </div>
                        
                    <?php  } ?>
                    
                    <div class="row ms-5">
                        <div class="col-6 ps-0">
                            <?php if ($meal_saved) { ?>
                                <div class="alert alert-success col-6 mb-3" role="alert">
                                    Meal plan saved successfully!
                                </div>
                                <a href=""  class="btn btn-primary ml-0 me-2">Generate new plan</a>
                            <?php } else { 
                                    echo "<button type='submit' class='btn btn-success me-2' name='save-meal-plan'>Record meal plan</button>";
                                }
                            ?>
                            
                            <a href="./myServices.php"  class="btn btn-outline-dark">Back to service selection</a>
                        </div>
                    </div>
                </form>
            </div>

        <?php } ?>
        
        <?php if (($errors || !isset($_POST["activity"])) && $service_id !=4) { ?>
            
            <div class="row my-3 justify-content-center">
                <form method="POST" class="col-6">
                    <div class="mb-3">
                        <label for="activity-duration" class="form-label">Enter activity duration (minutes)</label>
                        <input type="text" class="form-control" id="activity-duration" name="activity-duration">
                        <?= displayText($errors, 'activity-duration'); ?>
                    </div>
                    <button type="submit" class="btn btn-success" name="activity">Record</button>
                    <a href="./myServices.php"  class="btn btn-outline-dark ms-3">Back to service selection</a>
                </form>
            </div>
        
        <?php } else if ($service_id != 4) { ?>
            
            <div class="row my-3 justify-content-center">
                <div class="alert alert-success col-6 mb-0" role="alert">
                    You have successfully completed <?= $_POST["activity-duration"] ?> minutes of activity!
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 ps-0">
                    <a href=""  class="btn btn-primary ml-0">Continue activity</a>
                    <a href="./myServices.php"  class="btn btn-outline-dark ms-3">Back to service selection</a>
                </div>
            </div>
            
        <?php } ?>
    </div>
            
    <?php 
        echo "</main>";
        require_once("./includes/footer.php");
    ?>
    
</body>
</html>