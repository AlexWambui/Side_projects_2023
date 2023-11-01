<?php
//error_reporting(0);
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_housemaid_portal";
$db_connection = mysqli_connect($hostname, $username, $password, $database)
or die("<b>Connection to the server couldn't be established. Try starting mysql on Xampp or contact the developer for help!</b>");


// General Functions
function protect_page()
{
    session_start();
    if (!isset($_SESSION['id'])) header("location: ../index.php");
}
function admin_page()
{
    session_start();
    if ($_SESSION['user_level'] != 2) header('location: welcome_page.php');
}
function alert()
{
    if (isset($_COOKIE['error'])): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oooops!</strong> <?= $_COOKIE['error'] ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_COOKIE['success'])): ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <?= $_COOKIE['success'] ?>
    </div>
<?php endif;
}
function fetch_all($table_name): mysqli_result|bool
{
    global $db_connection;
    $sql_fetch_all = $db_connection->query("SELECT * FROM $table_name") or die(mysqli_error($db_connection));
    return $sql_fetch_all;
}
function count_all($table_name): int
{
    return mysqli_num_rows(fetch_all($table_name));
}
function fetch_this_row($table_name): mysqli_result|bool
{
    global $db_connection;
    $update_id = $_REQUEST['update_id'];
    return $db_connection->query("SELECT * FROM $table_name WHERE id = '$update_id' ");
}
function delete($table_name)
{
    global $db_connection;
    $delete_id = $_REQUEST['delete_id'];
    $sql_delete = mysqli_prepare($db_connection, "DELETE FROM $table_name WHERE id = '$delete_id' ");
    mysqli_stmt_execute($sql_delete) or die(mysqli_stmt_error($sql_delete));
}


// User Related Functions
function signup_user()
{
    global $db_connection;
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];
    $user_level = $_REQUEST['user_level'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql_register_user = mysqli_prepare($db_connection, "INSERT INTO users (`first_name`, `last_name`, `phone_number`, `email_address`, `username`, `password`, `user_level`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_register_user, "ssssssi", $first_name, $last_name, $phone, $email, $username, $password, $user_level,);
    mysqli_stmt_execute($sql_register_user) or die(mysqli_stmt_error($sql_register_user));
    setcookie("success", "Registered successfully! Login.", time() + 2);
    header('location: login.php');
}
function login()
{
    global $db_connection;

    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql_fetch_users = mysqli_prepare($db_connection, "SELECT * FROM users WHERE username = ? LIMIT 1");
    mysqli_stmt_bind_param($sql_fetch_users, "s", $username);
    mysqli_stmt_execute($sql_fetch_users);
    $fetched_users = mysqli_stmt_get_result($sql_fetch_users);

    //if username is found
    if (mysqli_num_rows($fetched_users) == 1) {
        $user = mysqli_fetch_assoc($fetched_users);
        if ($user['password'] == $password) {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email_address'];
            $_SESSION['user_level'] = $user['user_level'];
            $_SESSION['verification'] = $user['verification'];
            header('location: welcome_page.php');
        } else {
            setcookie("error", "Wrong Credentials!", time() + 2);
            header('location: ./login.php');
        }
    } else {
        setcookie("error", "Wrong Credentials!", time() + 2);
        header('location: ./login.php');
    }
}
function greet_user(): string
{
    return 'Hi ' . $_SESSION['first_name'];
}
function fetch_user_session($table_name): mysqli_result|bool
{
    global $db_connection;
    $id = $_SESSION['id'];
    $sql_fetch_where = $db_connection->query("SELECT * FROM $table_name WHERE id = '$id' ") or die(mysqli_error($db_connection));
    return $sql_fetch_where;
}
function update_basic_information()
{
    global $db_connection;

    $id = $_SESSION['id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $phone = $_REQUEST['phone_number'];
    $email = $_REQUEST['email_address'];
    $password = $_REQUEST['password'];
    $residence = $_REQUEST['residence'];

    $sql_query = mysqli_prepare($db_connection, "UPDATE users SET `first_name` = '$first_name', `last_name` = '$last_name', `phone_number` = '$phone', `email_address` = '$email', `password` = '$password', `residence` = '$residence' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_query) or die(mysqli_stmt_error($sql_query));
    setcookie('success', 'Profile updated successfully!', time() + 2);
    header('location: ./login.php');
}
function update_profile()
{
    global $db_connection;

    $id = $_SESSION['id'];
    $skills = $_REQUEST['skills'];
    $bio = $_REQUEST['bio'];

    $sql_query = mysqli_prepare($db_connection, "UPDATE users SET `skills` = '$skills', `bio` = '$bio' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_query) or die(mysqli_stmt_error($sql_query));
    setcookie('success', 'Profile updated Successfully', time() + 2);
    header('location: ./update_profile.php');
}
function account_verification($verification)
{
    global $db_connection;

    $update_id = $_REQUEST['update_id'];
    $sql_update_account = mysqli_prepare($db_connection, "UPDATE users SET verification = '$verification' WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_account) or die(mysqli_stmt_error($sql_update_account));
    header('location: ./users.php');
}
function fetch_user_level($user_level): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_user_level = $db_connection->query("SELECT * FROM users WHERE user_level = '$user_level'") or die(mysqli_error($db_connection));
    return $sql_fetch_user_level;
}
function count_all_user_level($user_level): int
{
    return mysqli_num_rows(fetch_user_level($user_level));
}
function fetch_user_verifications($verification): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_user_verification = $db_connection->query("SELECT * FROM users WHERE verification = '$verification' AND user_level != 3 ") or die(mysqli_error($db_connection)) ;
    return $sql_fetch_user_verification;
}
function count_user_verification($verification): int
{
    return mysqli_num_rows(fetch_user_verifications($verification));
}
function logout()
{
    session_start();
    session_destroy();
    header('location: ../../login.php');
}
if (isset($_POST['logout_btn'])) logout();



// Job Related Functions
function add_job()
{
    global $db_connection;

    $user_id = $_SESSION['id'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $salary = $_REQUEST['salary'];
    $status = $_REQUEST['status'];

    $sql_add_job = mysqli_prepare($db_connection, "INSERT INTO jobs (`user_id`, `job_title`, `job_description`, `salary`, `job_status`) VALUES(?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($sql_add_job, "issis", $user_id, $title, $description, $salary, $status);
    mysqli_stmt_execute($sql_add_job) or die(mysqli_stmt_error($sql_add_job));
    setcookie('success', 'Job has been added!', time() + 2);
    header('location: jobs.php');
}
function update_job()
{
    global $db_connection;

    $id = $_REQUEST['job_id'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $salary = $_REQUEST['salary'];

    $sql_update_job = mysqli_prepare($db_connection, "UPDATE jobs SET `job_title` = '$title', `job_description` = '$description', `salary` = '$salary' WHERE jobs.id = '$id' ");
    mysqli_stmt_execute($sql_update_job) or die(mysqli_stmt_error($sql_update_job));
    setcookie('success', 'Job has been updated!', time() + 2);
    header('location: jobs.php');
}
function delete_job()
{
    delete('jobs');
    setcookie("success", "Job has been deleted 😮.", time() + 2);
    header('location: ./jobs.php');
}
function job_status($job_status)
{
    global $db_connection;

    $id = $_REQUEST['job_id'];
    $sql_update_account = mysqli_prepare($db_connection, "UPDATE jobs SET job_status = '$job_status' WHERE id = '$id' ");
    mysqli_stmt_execute($sql_update_account) or die(mysqli_stmt_error($sql_update_account));
    header('location: ./jobs.php');
}
function fetch_all_jobs(): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_all_jobs = $db_connection->query("SELECT users.id AS user_id, users.first_name, users.last_name, users.phone_number, users.email_address, users.username, users.verification, users.residence, users.skills, jobs.id AS job_id, jobs.job_title, jobs.job_description, jobs.salary, jobs.job_status FROM jobs JOIN users ON users.id = jobs.user_id") or die(mysqli_error($db_connection));
    return $sql_fetch_all_jobs;
}
function fetch_all_open_jobs(): mysqli_result|bool
{
    global $db_connection;

    $job_status = 'open';
    $sql_fetch_all_jobs = $db_connection->query("SELECT users.id AS user_id, users.first_name, users.last_name, users.phone_number, users.email_address, users.username, users.verification, users.residence, users.skills, jobs.id AS job_id, jobs.job_title, jobs.job_description, jobs.salary, jobs.job_status FROM jobs JOIN users ON users.id = jobs.user_id WHERE job_status = '$job_status' ") or die(mysqli_error($db_connection));
    return $sql_fetch_all_jobs;
}
function fetch_users_jobs(): mysqli_result|bool
{
    global $db_connection;

    $id = $_SESSION['id'];
    $sql_fetch_all_jobs = $db_connection->query("SELECT users.id AS user_id, users.first_name, users.last_name, users.phone_number, users.email_address, users.username, users.verification, users.residence, users.skills, jobs.id AS job_id, jobs.job_title, jobs.job_description, jobs.salary, jobs.job_status FROM jobs JOIN users ON users.id = jobs.user_id WHERE jobs.user_id = '$id' ") or die(mysqli_error($db_connection));
    return $sql_fetch_all_jobs;
}
function fetch_this_job(): mysqli_result|bool
{
    global $db_connection;

    $id = $_REQUEST['job_id'];
    $sql_fetch_all_jobs = $db_connection->query("SELECT users.id AS user_id, users.first_name, users.last_name, users.email_address, users.phone_number, users.username, users.verification, users.residence, users.skills, jobs.id AS job_id, jobs.job_title, jobs.job_description, jobs.salary, jobs.job_status FROM jobs JOIN users ON users.id = jobs.user_id WHERE jobs.id = '$id' ") or die(mysqli_error($db_connection));
    return $sql_fetch_all_jobs;
}
function fetch_job_openings(): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_job_openings = $db_connection->query("SELECT * FROM jobs WHERE job_status = 'open' ") or die(mysqli_error($db_connection));
    return $sql_fetch_job_openings;
}
function count_job_openings(): int
{
    return mysqli_num_rows(fetch_job_openings());
}
function count_users_jobs(): int
{
    return mysqli_num_rows(fetch_users_jobs());
}



// Job Application Related Functions
function apply_for_job()
{
    global $db_connection;

    $maid_id = $_SESSION['id'];
    $job_id = $_REQUEST['job_id'];
    $sql_apply_for_job = mysqli_prepare($db_connection, "INSERT INTO job_applications (`maid_id`, `job_id`) VALUES(?, ?)");
    mysqli_stmt_bind_param($sql_apply_for_job, "ii", $maid_id, $job_id);
    mysqli_stmt_execute($sql_apply_for_job) or die(mysqli_stmt_error($sql_apply_for_job));
    setcookie('success', 'Job application has been sent', time() + 2);
    header('location: ./jobs.php');
}
function delete_job_application()
{
    delete('job_applications');
    setcookie("success", "Job applications has been deleted 😮.", time() + 2);
    header('location: ./job_applications.php');
}
function fetch_all_job_applications(): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch_all_job_applications = $db_connection->query("SELECT * FROM job_applications JOIN users ON job_applications.maid_id = users.id JOIN jobs ON job_applications.job_id = jobs.id") or die($db_connection);
    return $sql_fetch_all_job_applications;
}
function fetch_user_job_applications(): mysqli_result|bool
{
    global $db_connection;

    $id = $_SESSION['id'];
    $sql_fetch_all_job_applications = $db_connection->query("SELECT * FROM job_applications JOIN users ON job_applications.maid_id = users.id JOIN jobs ON job_applications.job_id = jobs.id WHERE maid_id = '$id' ") or die($db_connection);
    return $sql_fetch_all_job_applications;
}
function fetch_maid_seekers_job_applications(): mysqli_result|bool
{
    global $db_connection;

    $id = $_SESSION['id'];
    $sql_fetch_maid_seekers_job_applications = $db_connection->query("SELECT users.id AS user_id, users.first_name, users.last_name, users.email_address, users.phone_number, users.username, users.verification, users.residence, users.skills, jobs.id AS job_id, jobs.job_title, jobs.job_description, jobs.salary, jobs.job_status, job_applications.id As job_applications_id, job_applications.application_status FROM job_applications JOIN users ON job_applications.maid_id = users.id JOIN jobs ON job_applications.job_id = jobs.id WHERE jobs.user_id = '$id' ") or die($db_connection);
    return $sql_fetch_maid_seekers_job_applications;
}
function count_maid_seekers_job_applications(): int
{
    return mysqli_num_rows(fetch_maid_seekers_job_applications());
}
function job_application_status($application_status)
{
    global $db_connection;

    $id = $_REQUEST['job_id'];
    $sql_update_account = mysqli_prepare($db_connection, "UPDATE job_applications SET application_status = '$application_status' WHERE job_applications.id = '$id' ");
    mysqli_stmt_execute($sql_update_account) or die(mysqli_stmt_error($sql_update_account));
    setcookie('success', 'Job Application has been updated!', time() + 2);
    header('location: ./job_applications.php');
}
function count_user_job_applications(): int
{
    return mysqli_num_rows(fetch_user_job_applications());
}

function fetch_job_applications($application_status): mysqli_result|bool
{
    global $db_connection;

    $sql_fetch = $db_connection->query("SELECT * FROM job_applications WHERE application_status = '$application_status'") or die(mysqli_error($db_connection));
    return $sql_fetch;
}
function count_job_applications($application_status): int
{
    return mysqli_num_rows(fetch_job_applications($application_status));
}

function update_user_profile()
{
    global $db_connection;
    $update_id = $_REQUEST['update_id'];
    $first_name = $_REQUEST['first_name'];
    $last_name = $_REQUEST['last_name'];
    $email = $_REQUEST['email_address'];
    $tel = $_REQUEST['phone_number'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    $sql_update_user_profile = mysqli_prepare($db_connection, "UPDATE `users` SET `first_name`='$first_name',`last_name`='$last_name',`phone_number` = '$tel', `email_address` = '$email', `username` = '$username', `password` = '$password'  WHERE id = '$update_id' ");
    mysqli_stmt_execute($sql_update_user_profile) or die(mysqli_stmt_error($sql_update_user_profile));
    setcookie("success", "profile updated. Login!", time() + 2);
    header('location: ../../index.php');
}
