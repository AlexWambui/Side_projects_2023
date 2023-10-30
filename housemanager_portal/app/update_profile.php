<?php
include_once "include/functions.php";
protect_page();
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
            <div class="col-6 mt-3">
                <div class="card">
                    <h5 class="card-header text-center">Update Profile</h5>
                    <div class="card-body">
                        <?php foreach(fetch_user_session('users') as $user): ?>
                            <form action="include/functions.php" method="post">
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
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?= $user['phone_number'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Email Address</label>
                                    <input type="email" name="email_address" id="email_address" class="form-control" value="<?= $user['email_address'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="password" class="form-control" value="<?= $user['username'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" value="<?= $user['password'] ?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="update_user_profile">Update</button>
                                </div>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>

