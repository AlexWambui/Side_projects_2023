<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Home Page</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="Dashboard">
    <div class="container">
        <h3 class="mt-4">Hi <?= $_SESSION['first_name'] ?></h3>
        <div class="stats mt-4">
            <div class="stat">
                <span class="icon icon-cab"></span>
                <span><?= count_today_vehicles() ?></span>
                <span>Taxis parked today</span>
            </div>

            <div class="stat">
                <span class="icon icon-money"></span>
                <span><?= calc_total_amount_today() ?></span>
                <span>Kshs Collected today</span>
            </div>

            <div class="stat">
                <span class="icon icon-car"></span>
                <span><?= count_all_vehicles() ?></span>
                <span>Taxis Parked so far</span>
            </div>

            <div class="stat">
                <span class="icon icon-money"></span>
                <span><?= calc_total_amount() ?></span>
                <span>Kshs Collected in total</span>
            </div>
        </div>
    </div>
</main>
</body>
</html>
