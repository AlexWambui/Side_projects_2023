<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['verify_account'])) account_verification('verified');
if (isset($_POST['suspend_account'])) account_verification('suspended');
if (isset($_POST['add_sale'])) add_sale();
if (isset($_POST['delete_sale'])) delete_sale();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Users</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container-fluid text-dark">
        <div class="row justify-content-center pt-3">
            <div class="col">
                <?= alert() ?>
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="row">
                            <div class="col">
                                <h5>Users</h5>
                            </div>
                            <div class="col text-right">
                                <h5>Pending: <?= count_user_verification('pending') ?></h5>
                            </div>
                            <div class="col text-right">
                                <h5>Verified: <?= count_user_verification('verified') ?></h5>
                            </div>
                            <div class="col text-right">
                                <h5>Suspended: <?= count_user_verification('suspended') ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="data_table">
                            <thead>
                            <tr>
                                <th>Names</th>
                                <th>User Level</th>
                                <th>Email Address</th>
                                <th>Username</th>
                                <th>Verification</th>
                                <th>Residence</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach (fetch_all('users') as $user)
                            {
                                if ($user['user_level'] != 3)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $user['first_name'] . ' ' . $user['last_name'] ?></td>
                                        <td>
                                            <?php
                                            if ($user['user_level'] == 1)
                                                echo 'house manager';
                                            else if ($user['user_level'] == 2)
                                                echo 'house manager seeker';
                                            else
                                                echo 'admin';
                                            ?>
                                        </td>
                                        <td><?= $user['email_address'] ?></td>
                                        <td><?= $user['username'] ?></td>
                                        <td class="<?php if($user['verification'] == 'suspended') echo 'text-danger'; elseif($user['verification'] == 'verified') echo 'text-success'; ?>"><?= $user['verification'] ?></td>
                                        <td><?= $user['residence'] ?></td>
                                        <td>
                                            <div class="action_buttons_wrapper">
                                                <div class="action_button">
                                                    <form action="./users.php" method="post">
                                                        <input type="hidden" name="update_id"
                                                               value="<?= $user['id'] ?>">
                                                        <button class="btn btn-success btn-sm" name="verify_account">
                                                            <span class="icon-check-circle"></span> Verify
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="action_button">
                                                    <form action="./users.php" method="post">
                                                        <input type="hidden" name="update_id"
                                                               value="<?= $user['id'] ?>">
                                                        <button class="btn btn-danger btn-sm" name="suspend_account">
                                                            <span class="icon-times-circle"></span> Suspend
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