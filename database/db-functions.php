<?php 

require_once("database.php");

// Sourced from WP Lectorial 8 code
const DNS = "mysql:host=" . SERVER_NAME . ";dbname=" . DB;

// -------------------------------------------
// General DB Functions

function createConnection() {
    return new PDO(DNS, USERNAME, PASSWORD);
}

// Sourced from WP Lectorial 10 Example 6 code
function prepAndExec($query, $params = null) {

    $pdo = createConnection();
    $statement = $pdo->prepare($query);
    $statement->execute($params);

    return $statement;
}

function prepExecFetchAll($query, $params = null) {
    $statement = prepAndExec($query, $params);

    // Note fetch and return associative array
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function prepExecFetch($query, $params = null) {
    $statement = prepAndExec($query, $params);

    return $statement->fetch(PDO::FETCH_ASSOC);
}


// -------------------------------------------
// User related

// Add a user to DB - used for join functionality
function insertUser($user) {

    $pdo = createConnection();
    
    $statement = $pdo->prepare(
        "INSERT INTO user(email, firstName, lastName, phone, birthday, studentStatus, employmentStatus, passwordHash) 
        values(:email, :firstName, :lastName, :phone, :birthday, :studentStatus, :employmentStatus, :password)"
    );
    
    return $statement->execute($user);
}

// Find a user with 'email' - used for log in functionality
function getUser($email) {

    $pdo = createConnection();

    $statement = $pdo->prepare(
        "SELECT * FROM user WHERE email = ?"
    );
    
    $statement->execute([$email]);

    return $statement->fetch();
}


// -------------------------------------------
// Services related

function getServices() {
    return prepExecFetchAll("SELECT * FROM service");
}

function getServiceInstructionTypes($service_id) {
    return prepExecFetchAll("SELECT service_type FROM service_instruction WHERE service_id = ?", [$service_id]); 
}

function getServiceInstruction($service_id, $service_type = null) {
    return prepExecFetch("SELECT * FROM service_instruction WHERE service_id = ? AND service_type = ?", [$service_id, $service_type]);
}

function insertActivity($activity) {

    $query = "INSERT INTO user_service(email, service_id, service_type, date_performed, duration_minutes) values(:email, :service_id, :service_type, now(), :duration_minutes)";

    return prepAndExec($query, $activity);
}


// -------------------------------------------
// Healthy Habits - Meal Planner

function getMeals($meal_type, $calories_per_meal) {

    
    if ($meal_type == "Anything") {
        $query = "SELECT * FROM meal";
        
        return prepExecFetchAll($query);
        
    } else {
        $query = "SELECT * FROM meal WHERE meal_type = ? AND calories <= ?";

        return prepExecFetchAll($query, [$meal_type, (int)$calories_per_meal]);
    }

}

function insertMealPlan($meal_plan) {

    $query = "INSERT INTO user_meal(email, meal_id, calories, date_saved) values(:email, :meal_id, :calories, now())";

    return prepAndExec($query, $meal_plan);
}


?>
