<header class="container-fluid app_navbar pt-2 pb-2">
    <div class="row align-items-center">
        <div class="col app_name">
            <a href="welcome_page.php" class="text-light">LATS MS</a>
        </div>
        <div class="col app_features">
            <a href="welcome_page.php">Dashboard</a>
            <a href="vehicles.php">Vehicles</a>
            <a href="reports.php">Reports</a>
        </div>
        <div class="col profile_details">
            <div class="btn-group dropdown" style="float:right;">
                <button type="button" class="btn btn-outline-dark btn-sm dropbtn dropdown-toggle">
                    <?= $_SESSION['first_name'] ?>
                </button>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="profile_page.php">profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="include/functions.php" method="post">
                        <button type="submit" name="logout" class="btn btn-danger btn-block">
                            logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>