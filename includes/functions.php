
<?php

session_start();

require_once("./database/db-functions.php");

const USER_SESSION_KEY = "user";
const MEAL_PLAN = "meal_plan";

// ----------------------------------------------
// Utilities

// Sourced from WP Lectorial 9 example 1 code
function displayText($text, $name) {
    if (isset($text[$name])) {
        echo "<div class='text-danger'>{$text[$name]}</div>";
    }
}

// Sourced from WP Lectorial 9 example 1 code
function redirect($location) {
    header("Location: $location");
    // Note: exit stops further scripts from running after redirecting
    exit();
}

// ----------------------------------------------
// Login-Logout functionality

// Sourced from WP Lectorial 9 Example 1 code and modified for use
function login($loginForm) {
    $errors = [];

    // Email format validation
    $key = "email-login";
    if (!preg_match("/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+$/", $loginForm[$key])) {
        $errors[$key] = "Email is invalid.";
    }

    // Password validation - if empty or not
    $key = "password";
    if ($loginForm[$key] === "") {
        $errors[$key] = "Password required.";
    }

    // Retrieve user from database
    if (!$errors) {
        $user = getUser(trim($loginForm["email-login"]));

        if ($user && $loginForm["password"] === $user["passwordHash"]) {
            $_SESSION[USER_SESSION_KEY] = $user;
        } else {
            $errors[$key] = "Sign-in failed, email and/or password incorrect. Please try again.";
            
        }
    }

    return $errors;
}

function logout() {
    session_unset();
}

function isLoggedIn() {
    return isset($_SESSION[USER_SESSION_KEY]);
}

function getLoggedUser() {
    return isLoggedin() ? $_SESSION[USER_SESSION_KEY] : null;
}


// ----------------------------------------------

// Services functions

function getModal($service_id) {
    
    $service_modal = "";

    if ($service_id == 1) {
        $service_modal = "data-bs-toggle='modal' data-bs-target='#yogaModal'";

    } else if ($service_id == 2) {
        $service_modal = "data-bs-toggle='modal' data-bs-target='#meditationModal'";

    } else if ($service_id == 3) {
        $service_modal = "data-bs-toggle='modal' data-bs-target='#stretchingModal'";

    } else if ($service_id == 4) {
        $service_modal = "data-bs-toggle='modal' data-bs-target='#healthyHabitsModal'";

    } 

    return $service_modal;
}

function recordActivity($service_id, $email, $service_type, $form) {
    $errors = [];
    $min = 1;
    $max = 360;

    $options = ["options" => array("min_range" => $min, "max_range" => $max)];

    $key = "activity-duration";
    if (!isset($form[$key]) || filter_var($form["$key"], FILTER_VALIDATE_INT, $options) === false) {
        $errors[$key] = "Duration can only be a whole number between " .$min . " and " . $max . "."; 

    }

    if (!$errors) {
        $activity = ["email" => $email, "service_id" => $service_id, "service_type" => $service_type, "duration_minutes" => htmlspecialchars($form[$key])];
        
        insertActivity($activity);

    }

    return $errors;
}

// Calculates the calories per meal and pseudo randomly (not really) selects corresponding number of meals
function generateMealPlan($meal_type, $target_calories, $number_of_meals) {

    $count_meals = $number_of_meals;

    $calories_per_meal = $target_calories / $count_meals;

    $meals = getMeals($meal_type, $calories_per_meal);

    if (count($meals) < $number_of_meals) {
        $count_meals = count($meals);
    }

    shuffle($meals);

    $meal_plan = array();
    
    for ($i = 0; $i < $count_meals; $i++) {

        $meal_plan[] = $meals[$i];

    }

    return $meal_plan;

}

function recordMealPlan($email, $meal_plan) {

    foreach($meal_plan as $meal) {
        $meal_plan_insert = ["email" => $email, "meal_id" => $meal["meal_id"], "calories" => $meal["calories"]];

        insertMealPlan($meal_plan_insert);
    }



}

?>