<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['add_job'])) add_job();
if (isset($_POST['open_job'])) job_status('open');
if (isset($_POST['close_job'])) job_status('closed');
if (isset($_POST['accept_job_application'])) job_application_status('accepted');
if (isset($_POST['decline_job_application'])) job_application_status('declined');
if (isset($_POST['delete_job'])) delete_job();
if (isset($_POST['delete_job_application'])) delete_job_application();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Job Applications</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container-fluid text-dark">
        <div class="row justify-content-center pt-3">
            <div class="col">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Job Applications</h5>
                            </div>
                            <div class="col text-right">
                                <?php if($_SESSION['user_level'] != 1): ?>
                                    <h5>Total applications: <?= count_maid_seekers_job_applications() ?></h5>
                                <?php endif; ?>
                                <?php if($_SESSION['user_level'] == 1): ?>
                                    <h5>Total applications: <?= count_user_job_applications() ?></h5>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <th>Job Title</th>
                                <th>Manager's Names</th>
                                <th>Manager's Email</th>
                                <th>Manager's Tel</th>
                                <th>Residence</th>
                                <th>Skills</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($_SESSION['user_level'] == 1)
                            {
                                foreach (fetch_user_job_applications() as $job)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $job['job_title'] ?> </td>
                                        <td><?= $job['first_name'] . ' ' . $job['last_name'] ?></td>
                                        <td><?= $job['email_address'] ?> </td>
                                        <td><?= $job['phone_number'] ?> </td>
                                        <td><?= $job['residence'] ?> </td>
                                        <td><?= $job['skills'] ?> </td>
                                        <td><?= $job['application_status'] ?></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <div class="action_button">
                                                    <form action="./job_applications.php" method="post">
                                                        <input type="hidden" name="delete_id"
                                                               value="<?= $job['id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                name="delete_job_application"><span
                                                                    class="icon-trash"></span>
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if ($_SESSION['user_level'] == 2)
                            {
                                foreach (fetch_maid_seekers_job_applications() as $job)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $job['job_title'] ?> </td>
                                        <td><?= $job['first_name'] . ' ' . $job['last_name'] ?></td>
                                        <td><?= $job['email_address'] ?> </td>
                                        <td><?= $job['phone_number'] ?> </td>
                                        <td><?= $job['residence'] ?> </td>
                                        <td><?= $job['skills'] ?> </td>
                                        <td><?= $job['application_status'] ?></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <div class="action_button">
                                                    <form action="./job_applications.php" method="post">
                                                        <input type="hidden" name="job_id"
                                                               value="<?= $job['job_applications_id'] ?>">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                                name="accept_job_application"><span
                                                                    class="icon-check-circle"></span>
                                                            Accept
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="action_button">
                                                    <form action="./job_applications.php" method="post">
                                                        <input type="hidden" name="job_id"
                                                               value="<?= $job['job_applications_id'] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                                name="decline_job_application"><span
                                                                    class="icon-times"></span>
                                                            Decline
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "include/transform_data_table.php" ?>
</body>
</html>