<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_job'])) add_job();
if (isset($_POST['open_job'])) job_status('open');
if (isset($_POST['close_job'])) job_status('closed');
if (isset($_POST['apply_for_job'])) apply_for_job();
if (isset($_POST['delete_job'])) delete_job();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Report</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content Reports">
    <div class="container-fluid">
        <div class="container-fluid row mt-3 justify-content-center">
            <div class="col">
                <h4>HMRP Report</h4>
            </div>
            <div class="col text-right">
                <h5>Date: <?= date('d-M-Y') ?></h5>
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-info">
                        <h5>Users</h5>
                    </div>
                    <div class="card-body">
                        <p>Total Users: <span class="badge badge-info"><?= count_all('users') ?></span></p>
                        <p>Verified Users: <span class="badge badge-success"><?= count_user_verification('verified') ?></span></p>
                        <p>Pending verifications: <span class="badge badge-warning"><?= count_user_verification('pending') ?></span></p>
                        <p>Suspended Users: <span class="badge badge-danger"><?= count_user_verification('suspended') ?></span></p>
                        <p>No. of House Managers: <span class="badge badge-info"><?= count_all_user_level(1) ?></span></p>
                        <p>No. of House Manager Seekers: <span class="badge badge-info"><?= count_all_user_level(2) ?></span></p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h5>Jobs</h5>
                    </div>
                    <div class="card-body">
                        <p>Total Jobs posted: <span class="badge badge-info"><?= count_all('jobs') ?></span></p>
                        <p>No. of applications sent: <span class="badge badge-info"><?= count_all('job_applications') ?></span></p>
                        <p>No. of pending applications: <span class="badge badge-warning"><?= count_job_applications('pending') ?></span></p>
                        <p>No. of applications accepted: <span class="badge badge-success"><?= count_job_applications('accepted') ?></span></p>
                        <p>No. of applications declined: <span class="badge badge-danger"><?= count_job_applications('declined') ?></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>