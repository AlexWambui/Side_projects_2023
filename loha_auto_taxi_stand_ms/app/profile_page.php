<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Profile Page</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<section class="main_content">
    <div class="row justify-content-center">
        <div class="col-6 mt-5">
            <div class="card">
                <h5 class="card-header text-center">Profile</h5>
                <div class="card-body">
                    <?php foreach (fetch_user_profile() as $user): ?>
                        <form action="include/functions.php" method="post">
                            <input type="hidden" name="user_id" id="user_id" value="<?= $user['id'] ?>">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control" required value="<?= $user['first_name'] ?>">
                                    </div>
                                    <div class="col">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control" required value="<?= $user['last_name'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="<?= $user['username'] ?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" id="email_address" placeholder="Email Address" class="form-control" required value="<?= $user['email_address'] ?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="New password">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="update_user_profile" id="update_user_profile" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
