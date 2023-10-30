<?php
include_once "include/functions.php";
if (isset($_POST['signup_btn'])) signup_user();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Signup</title>
</head>
<body>
<main class="main_content">
    <div class="container-fluid account_page Signup">
        <div class="row justify-content-center">
            <div class="col-7 mt-3">
                <div class="card text-dark">
                    <div class="card-header bg-primary">
                        <h5 class="text-center text-white">Signup</h5>
                    </div>
                    <div class="card-body">
                        <form action="./signup.php" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="phone_number">Phone Number</label>
                                        <input type="text" name="phone_number" id="phone_number" class="form-control" placeholder="Phone Number" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="email_address">Email Address</label>
                                        <input type="email" name="email_address" id="email_address" class="form-control" placeholder="Email Address" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="user_level">I am a:</label>
                                <br>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="maid" name="user_level" value="1">
                                    <label class="custom-control-label" for="maid">House manager</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" id="maid_seeker" name="user_level" value="2">
                                    <label class="custom-control-label" for="maid_seeker">House Manager Seeker</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary account_btn" name="signup_btn">Signup</button>
                            </div>
                        </form>
                        <p class="text-center">Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>