<?php
include_once "include/functions.php";
protect_page();
if (isset($_POST['update_job'])) update_job();
?>
<!doctype html>
<html lang="en"a>
<head>
    <?php include_once "include/head_section.php" ?>
    <title>Job | update</title>
</head>
<body>
<?php include_once "include/navbar.php" ?>
<main>
    <div class="container text-dark">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <div class="card">
                    <h5 class="card-header text-center">Update Job</h5>
                    <div class="card-body">
                        <?php foreach(fetch_this_job() as $job): ?>
                            <form action="./update_job.php" method="post">
                                <input type="hidden" name="job_id" value="<?= $job['job_id'] ?>">
                                <div class="form-group">
                                    <label for="title">Job Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                           placeholder="Job Title" value="<?= $job['job_title'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="description">Job Description</label>
                                    <input type="text" name="description" id="description"
                                           class="form-control" placeholder="Job Description" value="<?= $job['job_description'] ?>"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="salary">Salary</label>
                                    <input type="number" name="salary" id="salary"
                                           class="form-control" placeholder="Salary" value="<?= $job['salary'] ?>" required>
                                </div>
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-success" name="update_job">Update</button>
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

