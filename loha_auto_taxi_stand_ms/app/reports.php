<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Reports</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-10 mt-2">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <span>Amount: <?= calc_total_amount() ?></span>
                        </div>
                        <div class="col text-right">
                            <span>Vehicles: <?= count_all_vehicles() ?></span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="data_table">
                        <thead>
                        <tr>
                            <th>Reg. No</th>
                            <th>Time in</th>
                            <th>Time out</th>
                            <th>Total Hours</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach(fetch_all_vehicles() as $vehicle): ?>
                            <tr>
                                <td><?= $vehicle['registration_number'] ?></td>
                                <td><?= $vehicle['arrival_time'] ?></td>
                                <td><?= $vehicle['departure_time'] ?></td>
                                <td>Kshs. 100/hour</td>
                                <td><?= round(time_taken($vehicle['arrival_time'], $vehicle['departure_time']) * 100, 2) ?> shs</td>
                                <td><?= $vehicle['date_today'] ?></td>
                                <td>
                                    <div class="action_container">
                                        <div class="action">
                                            <form action="parking_receipt.php">
                                                <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                                                <button class="btn btn-warning btn-sm" name="generate_receipt"><span class="icon-print2"></span> Receipt</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/data_table.js"></script>
</body>
</html>
