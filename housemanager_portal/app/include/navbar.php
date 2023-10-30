<header class="container-fluid">
    <div class="row">
        <div class="col app_name">
            <p>HouseManager Recruitment Portal</p>
        </div>
        <div class="col app_features">
            <a href="welcome_page.php">Dashboard</a>
            <?php if($_SESSION['user_level'] == 3): ?>
                <a href="users.php">Users</a>
            <?php endif; ?>
            <?php if($_SESSION['user_level'] != 3): ?>
            <a href="profile.php">Profile</a>
            <?php endif; ?>
            <a href="jobs.php">Jobs</a>
            <?php if($_SESSION['user_level'] != 3): ?>
            <a href="job_applications.php">Applications</a>
            <?php endif; ?>
            <?php if($_SESSION['user_level'] == 3): ?>
                <a href="reports.php">Reports</a>
            <?php endif; ?>
        </div>
        <div class="col profile_details">
            <div class="btn-group dropdown" style="float:right;">
                <button type="button" class="btn btn-dark btn-sm dropbtn dropdown-toggle">
                    <?= $_SESSION['username'] ?>
                </button>
                <div class="dropdown-content">
                    <a class="dropdown-item" href="update_profile.php">profile</a>
                    <div class="dropdown-divider"></div>
                    <form action="include/functions.php" method="post">
                        <div class="form-group">
                            <button type="submit" name="logout_btn" class="dropdown-item">logout</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>