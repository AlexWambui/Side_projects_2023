<?php
include_once "include/functions.php";
protect_page();
if(isset($_POST["update_basic_information"])) update_basic_information();
if(isset($_POST["update_profile"])) update_profile();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Request | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container text-dark">
        <div class="row justify-content-center">
            <?= alert() ?>
            <div class="container mt-3">
                <div class="card">
                    <h5 class="card-header text-center">Basic Information</h5>
                    <div class="card-body">
                        <?php foreach(fetch_user_session('users') as $user): ?>
                            <form action="./update_profile.php" method="post">
                                <input type="hidden" name="update_id" value="<?= $user['id'] ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $user['first_name'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $user['last_name'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?= $user['phone_number'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="last_name">Email Address</label>
                                            <input type="email" name="email_address" id="email_address" class="form-control" value="<?= $user['email_address'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="username">Username</label>
                                            <input type="text" name="username" id="password" class="form-control" value="<?= $user['username'] ?>" required>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control" value="<?= $user['password'] ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="residence">Residence</label>
                                    <input type="text" name="residence" id="residence" class="form-control" placeholder="residence" value="<?= $user['residence'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success" name="update_basic_information">Update</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <?php if($_SESSION['user_level'] == 1): ?>
            <div class="container mt-3">
                <div class="card">
                    <h5 class="card-header text-center">Profile</h5>
                    <div class="card-body">
                        <?php foreach(fetch_user_session('users') as $user): ?>
                            <form action="./update_profile.php" method="post">

                                <div class="form-group">
                                    <label for="skills">Skills</label>
                                    <input type="text" name="skills" id="skills" class="form-control" placeholder="Skills" value="<?= $user['skills'] ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" id="bio" class="form-control" placeholder="Enter a brief description of yourself" rows=5 required><?= $user['bio'] ?></textarea>
                                </div>

                                <button class="btn btn-success" name="update_profile">Update</button>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>
</body>
</html>
