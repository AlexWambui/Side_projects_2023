<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Dashboard</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container mt-3 text-center">
        <h2>Hi
            <?php
                echo $_SESSION['first_name'];
                if($_SESSION['verification'] == 'verified')
                {
                    echo ' <span class="icon-check text-primary"></span>';
                }
                else {
                    echo ' <span class="text-danger">!</span>';
                }
            ?>
        </h2>
        <p>Welcome to your dashboard!</p>
    </div>
    <div class="container dashboard_container">
        <?php if($_SESSION['user_level'] == 3): ?>
        <div class="dashboard_content bg-info text-white">
            <h1><?= count_all('users') ?></h1>
            <h6>Users</h6>
        </div>

        <div class="dashboard_content bg-warning">
            <h1><?= count_all_user_level(1) ?></h1>
            <h6>House Managers</h6>
        </div>

        <div class="dashboard_content bg-primary text-white">
            <h1><?= count_all_user_level(2) ?></h1>
            <h6>House Manager Seekers</h6>
        </div>
        <?php endif; ?>

        <?php if($_SESSION['user_level'] == 2): ?>
        <div class="dashboard_content">
            <h1><?= count_users_jobs() ?></h1>
            <p>Job Post(s) by You</p>
        </div>

        <div class="dashboard_content">
            <h1><?= count_maid_seekers_job_applications() ?></h1>
            <p>Job Applications to You</p>
        </div>
        <?php endif; ?>

        <?php if($_SESSION['user_level'] == 1): ?>
        <div class="dashboard_content">
            <h1><?= count_all('jobs') ?></h1>
            <p>Available Jobs</p>
        </div>

        <div class="dashboard_content">
            <h1><?= count_user_job_applications() ?></h1>
            <p>Job Applications Sent</p>
        </div>
        <?php endif; ?>
    </div>
</main>
</body>
</html>