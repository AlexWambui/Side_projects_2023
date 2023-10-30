<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>LATS MS Receipt</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<section class="Receipt">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-7 mt-5">
                <?php foreach(this_vehicle() as $vehicle): ?>
                <div class="receipt_wrapper">
                    <div class="header">
                        <h1>Loha Auto Taxi Stand Management System</h1>
                        <div class="header_details row justify-content-between">
                            <p class="col"><b>Date:</b> <?= date('d F, Y') ?></p>
                            <p class="col text-right"><b>Receipt id:</b> <?= 'LATS'.rand(1000, 5000) ?></p>
                        </div>
                    </div>
                    <div class="body mt-4">
                        <p>Registration Number: <span><?= $vehicle['registration_number'] ?></span></p>
                        <p>Time in: <span><?= date('H:i', strtotime($vehicle['arrival_time'])) ?></span></p>
                        <p>Time out: <span><?= date('H:i', strtotime($vehicle['departure_time'])) ?></span></p>
                        <p>Amount (Ksh): <span><?= round(time_taken($vehicle['arrival_time'], $vehicle['departure_time']) * 100, 2) ?></span></p>
                    </div>
                    <div class="footer border-top mt-4 pt-3 pb-3">
                        <p class="m-0 text-center">You were served by: <b><?= $_SESSION['first_name'].' '.$_SESSION['last_name'] ?></b></p>
                        <p class="m-0 text-center">Welcome Again!</p>
                    </div>
                </div>
                <button type="button" onClick="window.print()" class="btn btn-warning mt-3"><span class="icon icon-print"></span> Print</button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
</body>
</html>