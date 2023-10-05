<?php

$db_connection = mysqli_connect("localhost", "root", "", "db_loha_auto_taxi_ms");

function protect_page()
{
    session_start();
    if(!isset($_SESSION['id'])){
        //Redirect the user to login page
        header("location: login.php");
    }
}

function logout_user(){
    session_start();
    session_destroy();
    header('location: ../../index.php');
}

function alert(){
    if(isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Error!</strong> <?= $_COOKIE['error'] ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_COOKIE['success'])): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Success!</strong> <?= $_COOKIE['success'] ?>
        </div>
    <?php endif;
}

if(isset($_POST["register_user"]))
{
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_signup_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `username`, `email_address`, `password`) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_signup_user, "sssss", $first_name, $last_name, $username, $email, $hashed_password);
    mysqli_stmt_execute($sql_signup_user) or die(mysqli_stmt_error($sql_signup_user));
    setcookie("success", "Successfully signed up. You can log in!", time()+2);
    header('location: ../login.php');
}

function login()
{
    global $db_connection;
    $login = $_REQUEST['email_or_username'];
    $password = $_REQUEST['password'];


    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
        $sql_fetch_users = mysqli_prepare($db_connection, "SELECT * FROM users WHERE email_address = ? LIMIT 1");
    } else {
        $sql_fetch_users = mysqli_prepare($db_connection, "SELECT * FROM users WHERE username = ? LIMIT 1");
    }

    mysqli_stmt_bind_param($sql_fetch_users, "s", $login);
    mysqli_stmt_execute($sql_fetch_users);
    $fetched_users = mysqli_stmt_get_result($sql_fetch_users);

    // If a user is found
    if(mysqli_num_rows($fetched_users) == 1) {
        $user = mysqli_fetch_assoc($fetched_users);
        if (password_verify($password, $user['password'])) { // Assuming you store hashed passwords
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email_address'];
            $_SESSION['user_level'] = $user['user_level'];
            header('location: ./welcome_page.php');
        } else {
            setcookie("error", "Ooops! Try again!", time() + 2);
            header('location: ./login.php');
        }
    } else {
        setcookie("error", "Oops! Try again!", time() + 2);
        header('location: ./login.php');
    }
}


if(isset($_POST['update_user_profile']))
{
    $id = $_REQUEST['user_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $username = $_REQUEST['username'];
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql_update_user_profile = mysqli_prepare($db_connection, "UPDATE users SET `first_name` = '$first_name', `last_name` = '$last_name', `username`='$username', `email_address` = '$email', `password` = '$hashed_password' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_user_profile) or die(mysqli_stmt_error($sql_update_user_profile));
    logout_user();
}

function fetch_user_profile(): array{
    global $db_connection;
    $id = $_SESSION['id'];

    $fetched_profile = $db_connection->query("SELECT * FROM users WHERE id = '$id' ");
    return (mysqli_fetch_all($fetched_profile, 1));
}

function save_vehicle_details()
{
    global $db_connection;

    $registration_number = $_REQUEST['registration_number'];
    $arrival = $_REQUEST['arrival_time'];
    $departure = $_REQUEST['departure_time'];

    $sql_save_vehicle_details = mysqli_prepare($db_connection,"INSERT INTO vehicles (`registration_number`, `arrival_time`, `departure_time`) VALUE(?, ?, ?)");
    mysqli_stmt_bind_param($sql_save_vehicle_details, "sss", $registration_number, $arrival, $departure);
    if(mysqli_stmt_execute($sql_save_vehicle_details) or die(mysqli_stmt_error($db_connection))){
        setcookie('success', 'Added successfully!', time() + 2);
        header('location: ./vehicles.php');
    }
    else{
        header('location: ./welcome_page.php');
    }
}

if(isset($_POST['update_vehicle_details']))
{
    $id = $_REQUEST['vehicle_id'];
    $registration = $_REQUEST['registration_number'];
    $arrival = $_REQUEST['arrival_time'];
    $departure = $_REQUEST['departure_time'];

    $sql_update_vehicle_details = mysqli_prepare($db_connection, "UPDATE vehicles SET `registration_number` = '$registration', `arrival_time` = '$arrival', `departure_time` = '$departure' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_vehicle_details) or die(mysqli_stmt_error($sql_update_vehicle_details));
    header('location: ../vehicles.php');
}

if(isset($_POST['delete_vehicle_details']))
{
    $id = $_REQUEST['vehicle_id'];
    $sql_delete_vehicle_details = mysqli_prepare($db_connection, "DELETE FROM vehicles WHERE id = '$id' ");
    mysqli_stmt_execute($sql_delete_vehicle_details) or die(mysqli_stmt_error($sql_delete_vehicle_details));
    header('location: ../vehicles.php');
}

function fetch_all_vehicles():mysqli_result|bool{
    global $db_connection;
    return $db_connection->query("SELECT * FROM `vehicles` ORDER BY date_created");
}

function fetch_today_vehicles(): mysqli_result|bool{
    global $db_connection;
    $today = date('Y-m-d');

    return $db_connection->query("SELECT * FROM `vehicles` WHERE date_today = '$today' ORDER BY date_created DESC");
}

function today_vehicles_as_array():array{
    return mysqli_fetch_all(fetch_today_vehicles(), 1);
}

function count_today_vehicles(): int
{
    return mysqli_num_rows(fetch_today_vehicles());
}

function calc_total_amount_today(): int|float{
    $total_today = 0;
    foreach(fetch_today_vehicles() as $vehicle){
        $total_today += round(time_taken($vehicle['arrival_time'], $vehicle['departure_time']) * 100, 2);
    }
    return $total_today;
}

function all_vehicles_as_array():array{
    return mysqli_fetch_all(fetch_all_vehicles(), 1);
}

function count_all_vehicles(): int
{
    return mysqli_num_rows(fetch_all_vehicles());
}

function calc_total_amount(): int|float{
    $total_amount = 0;
    foreach(fetch_all_vehicles() as $vehicle){
        $total_amount += round(time_taken($vehicle['arrival_time'], $vehicle['departure_time']) * 100, 2);
    }
    return $total_amount;
}

function this_vehicle():array
{
    global $db_connection;
    $id = $_REQUEST['vehicle_id'];

    return mysqli_fetch_all($db_connection->query("SELECT * FROM `vehicles` WHERE id= '$id' "), 1);
}

#[Pure] function time_taken($arrival_time, $departure_time): float|int
{
    $arrival_time = strtotime($arrival_time);
    $departure_time = strtotime($departure_time);
    $time_diff = abs($departure_time - $arrival_time)/3600;
    if($arrival_time <= 1632780000){
        return $time_diff = 0;
    }
    else if($departure_time <= 1632780000){
        return $time_diff = 0;
    }
    else{
        return $time_diff;
    }
}

if(isset($_POST['logout'])){
    logout_user();
}
