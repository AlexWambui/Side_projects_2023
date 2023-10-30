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
    <title>Jobs</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content Jobs_List">
    <div class="container-fluid text-dark">
        <div class="row justify-content-center pt-3">
            <div class="col">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col">
                                <?php
                                if ($_SESSION['user_level'] == 1) {
                                    echo "<h5>Available Jobs</h5>";
                                } elseif ($_SESSION['user_level'] == 2) {
                                    echo "<h5>Jobs You Posted</h5>";
                                } else {
                                    echo "<h5>Jobs</h5>";
                                }
                                ?>
                            </div>

                            <div class="col text-right">
                                <div class="modal fade" id="modalAddPayment" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h4 class="modal-title w-100 font-weight-bold">New Job</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left text-dark">
                                                <form action="./jobs.php" method="post" autocomplete="off">
                                                    <div class="form-group">
                                                        <label for="title">Job Title</label>
                                                        <input type="text" name="title" id="title" class="form-control"
                                                               placeholder="Job Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="description">Job Description</label>
                                                        <input type="text" name="description" id="description"
                                                               class="form-control" placeholder="Job Description"
                                                               required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="salary">Salary</label>
                                                        <input type="number" name="salary" id="salary"
                                                               class="form-control" placeholder="Salary" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Job Status</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="null">Select Job Status</option>
                                                            <option value="open">Open</option>
                                                            <option value="closed">Closed</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="submit" name="add_job" id="add_job"
                                                        class="btn btn-primary">
                                                    Save
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php if ($_SESSION['user_level'] == 2): ?>
                                    <a href="" class="btn btn-success btn-rounded text-right" data-toggle="modal"
                                       data-target="#modalAddPayment">New Job</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <?php if ($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 3): ?>
                                    <th>Employer</th>
                                    <th>Phone Number</th>
                                    <th>Residence</th>
                                <?php endif; ?>
                                <th>Job Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Salary</th>
                                <?php if ($_SESSION['user_level'] != 3): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($_SESSION['user_level'] == 3) {
                                foreach (fetch_all_jobs() as $job) {
                                    ?>
                                    <tr>
                                        <?php if ($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 3): ?>
                                            <td><?= $job['first_name'] . ' ' . $job['last_name'] ?></td>
                                            <td><?= $job['phone_number'] ?></td>
                                            <td><?= $job['residence'] ?></td>
                                        <?php endif; ?>
                                        <td><?= $job['job_title'] ?></td>
                                        <td><?= $job['job_description'] ?></td>
                                        <td class="<?php if ($job['job_status'] == 'open') echo 'text-success'; elseif ($job['job_status'] == 'closed') echo 'text-danger' ?>"><?= $job['job_status'] ?></td>
                                        <td><?= $job['salary'] ?></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <?php if ($_SESSION['user_level'] == 2): ?>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                    name="open_job"><span
                                                                        class="icon-check-circle"></span>
                                                                Open
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    name="close_job"><span
                                                                        class="icon-times-circle"></span>
                                                                Close
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="update_job.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                    name="edit"><span class="icon-pencil"></span> Edit
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post" onsubmit="return confirm('Are you sure you want to delete this Job Posting?');">
                                                            <input type="hidden" name="delete_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    name="delete_job"><span class="icon-trash"></span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['user_level'] == 1): ?>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                    name="apply_for_job"><span
                                                                        class="icon-send2"></span> Apply
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if ($_SESSION['user_level'] == 1)
                            {
                                foreach (fetch_all_open_jobs() as $job) {
                                    ?>
                                    <tr>
                                        <?php if ($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 3): ?>
                                            <td><?= $job['first_name'] . ' ' . $job['last_name'] ?></td>
                                            <td><?= $job['phone_number'] ?></td>
                                            <td><?= $job['residence'] ?></td>
                                        <?php endif; ?>
                                        <td><?= $job['job_title'] ?></td>
                                        <td><?= $job['job_description'] ?></td>
                                        <td class="<?php if ($job['job_status'] == 'open') echo 'text-success'; elseif ($job['job_status'] == 'closed') echo 'text-danger' ?>"><?= $job['job_status'] ?></td>
                                        <td><?= $job['salary'] ?></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <?php if ($_SESSION['user_level'] == 2): ?>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                    name="open_job"><span
                                                                        class="icon-check-circle"></span>
                                                                Open
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    name="close_job"><span
                                                                        class="icon-times-circle"></span>
                                                                Close
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="update_job.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                    name="edit"><span class="icon-pencil"></span> Edit
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="delete_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    name="delete_job"><span class="icon-trash"></span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['user_level'] == 1 && $_SESSION['verification'] == 'verified'): ?>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                    name="apply_for_job"><span
                                                                        class="icon-send2"></span> Apply
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php else:?>
                                                    <button class="btn btn-secondary disabled">Must be verified to apply</button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            if ($_SESSION['user_level'] == 2)
                            {
                                foreach (fetch_users_jobs() as $job) {
                                    ?>
                                    <tr>
                                        <?php if ($_SESSION['user_level'] == 1 || $_SESSION['user_level'] == 3): ?>
                                            <td><?= $job['first_name'] . ' ' . $job['last_name'] ?></td>
                                            <td><?= $job['phone_number'] ?></td>
                                            <td><?= $job['residence'] ?></td>
                                        <?php endif; ?>
                                        <td><?= $job['job_title'] ?></td>
                                        <td><?= $job['job_description'] ?></td>
                                        <td class="<?php if ($job['job_status'] == 'open') echo 'text-success'; elseif ($job['job_status'] == 'closed') echo 'text-danger' ?>"><?= $job['job_status'] ?></td>
                                        <td><?= $job['salary'] ?></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <?php if ($_SESSION['user_level'] == 2): ?>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                    name="open_job"><span
                                                                        class="icon-check-circle"></span>
                                                                Open
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    name="close_job"><span
                                                                        class="icon-times-circle"></span>
                                                                Close
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="update_job.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-success btn-sm"
                                                                    name="edit"><span class="icon-pencil"></span> Edit
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="delete_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    name="delete_job"><span class="icon-trash"></span>
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($_SESSION['user_level'] == 1): ?>
                                                    <div class="action_button">
                                                        <form action="./jobs.php" method="post">
                                                            <input type="hidden" name="job_id"
                                                                   value="<?= $job['job_id'] ?>">
                                                            <button type="submit" class="btn btn-warning btn-sm"
                                                                    name="apply_for_job"><span
                                                                        class="icon-send2"></span> Apply
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
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