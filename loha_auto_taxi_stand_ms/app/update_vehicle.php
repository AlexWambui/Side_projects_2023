<?php
include_once "include/functions.php";
protect_page();
?>
<!doctype html>
<html lang="en">
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Update_Vehicle</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-3">
                <div class="card">
                    <h5 class="card-header text-center">Update Vehicle Details</h5>
                    <div class="card-body">
                        <?php foreach(this_vehicle() as $vehicle): ?>
                        <form action="include/functions.php" method="post" autocomplete="off">
                            <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
                            <div class="form-group">
                                <label for="registration_number">Registration Number</label>
                                <input type="text" name="registration_number" is="registration_number" class="form-control validate" placeholder="Registration Number e.g. KDB 445Y" required value="<?= $vehicle['registration_number'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="arrival_time">Arrival Time</label>
                                <input type="time" name="arrival_time" id="arrival_time" class="form-control validate" required value="<?= $vehicle['arrival_time'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="departure_time">Departure Time</label>
                                <input type="time" name="departure_time" id="departure_time" class="form-control validate" value="<?= $vehicle['departure_time'] ?>">
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" name="update_vehicle_details" id="update_vehicle_details" class="btn btn-default">Update</button>
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