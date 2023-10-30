<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Sign up</title>
</head>
<body>
<header class="container-fluid index_page_header vh_8">
    <div class="navbar row align-items-center align-content-center">
        <div class="col-9 app_name">
            <a href="#">LAT MS</a>
        </div>
        <div class="col-3 login_links d-flex justify-content-around align-items-center align-content-center">
            <a href="../index.php">Home</a>
            <a href="login.php">Login</a>
        </div>
    </div>
</header>
<main class="index_page_main linear_gradient_image vh_92">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="card">
                    <h5 class="card-header text-center">Signup</h5>
                    <div class="card-body">
                        <form action="include/functions.php" method="post" autocomplete="off">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email_address">Email Address</label>
                                <input type="text" name="email_address" id="email_address" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="register_user" class="btn btn-success btn_registration">Sign up</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
