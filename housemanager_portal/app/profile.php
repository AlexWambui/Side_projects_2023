<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['update_profile'])) update_profile();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Profile</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="main_content">
    <div class="container-fluid mt-2">

        <?= alert() ?>
        <div class="row justify-content-center profile">
            <?php foreach(fetch_user_session('users') as $user): ?>
<!--            <div class="col-2 profile_body">-->
<!--                <div class="profile_pic">-->
<!--                    <img src="--><?//= $user['profile_picture'] ?><!--" alt="">-->
<!--                </div>-->
<!--                <div class="profile_pic_btn text-center">-->
<!--                    <a href="set_profile_picture.php" class="text-light">Set a Profile Picture</a>-->
<!--                </div>-->
<!--            </div>-->
            <div class="col-10 profile_body">
                <?php
                    if($_SESSION['user_level'] == 1)
                    {
                        echo "<h5 class='text-center'>What employers will see.</h5>";
                    }
                    else if ($_SESSION['user_level'] == 2)
                    {
                        echo "<h5 class='text-center text-white bg-primary p-3'>What House managers will see.</h5>";
                    }
                ?>
                <div class="card text-dark">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5>Profile</h5>
                            </div>
                            <div class="col">
                                <h5 class="text-right">Account Status:
                                    <span class="<?php if($user['verification'] == 'pending' || $user['verification'] == 'suspended') echo 'text-danger'; elseif($user['verification'] == 'verified') echo 'text-info icon-check-circle' ?>"><?= $user['verification'] ?>
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="./profile.php" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" value="<?= $user['phone_number'] ?>" required>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" value="<?= $user['email_address'] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="residence">Residence</label>
                                        <input type="text" name="residence" id="residence" class="form-control" placeholder="residence" value="<?= $user['residence'] ?>" required>
                                    </div>
                                </div>

                                <?php if($_SESSION['user_level'] == 1): ?>
                                <div class="col">
                                    <label for="skills">Skills</label>
                                    <input type="text" name="skills" id="skills" class="form-control" placeholder="Skills" value="<?= $user['skills'] ?>" required>
                                </div>
                                <?php endif; ?>
                            </div>

                            <?php if($_SESSION['user_level'] == 1): ?>
                            <div class="form-group">
                                <label for="bio">Bio</label>
                                <textarea name="bio" id="bio" class="form-control" placeholder="Enter a brief description of yourself" rows=5 required><?= $user['bio'] ?></textarea>
                            </div>
                            <?php endif; ?>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success" name="update_profile">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>
</body>
</html>