<?php
include_once "include/functions.php";
if (isset($_POST['login_user'])) login();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Login</title>
</head>
<body>
    <main class="Authentication_page login_page">
        <div class="container login">
            <h1 class="form_header">Login</h1>

            <?= alert() ?>

            <form action="" method="post" autocomplete="off">
                <div class="form-group">
                    <label for="email_or_username">Email Address or Username</label>
                    <input type="text" name="email_or_username" id="email_or_username" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group text-center">
                    <button type="submit" name="login_user" class="btn btn-block btn-success">Login</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
