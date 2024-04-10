
<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$job = $position = $salary = "";
$job_err = $position_err = $salary_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate job name
    $input_job= trim($_POST["job"]);
    if (empty($input_job)) {
        $job_err = "Please enter a detail correctly.";
    } 
    else {
        $job= $input_job;
    }

    // Validate position for this job role
    $input_position = trim($_POST["position"]);
    if (empty($input_position)) {
        $position_err = "Please enter a positions avilable.";
    } else {
        $position= $input_position;
    }

    // Validate salary
    $input_salary= trim($_POST["salary"]);
    if (empty($input_salary)) {
        $salary_err = "Please enter the amount.";
    } elseif (!ctype_digit($input_salary)) {
        $salary_err = "Please enter a positive integer value.";
    } else {
        $salary = $input_salary;
    }

    // Check input errors before inserting in database
    if (empty($job_err) && empty($position_err) && empty($salary_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO jobs (job, position, salary) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_job, $param_position, $param_salary);

            // Set parameters
            $param_job = $job;
            $param_position = $position;
            $param_salary= $salary;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Records created successfully. Redirect to landing page
                header("location: job.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add new job role to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Job name</label>
                            <input type="text" name="job" class="form-control <?php echo (!empty($job_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $job; ?>">
                            <span class="invalid-feedback"><?php echo $job_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>position available for this role</label>
                            <input type="text" name="position"class="form-control <?php echo (!empty($position_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $position; ?>">
                            <span class="invalid-feedback"><?php echo $position_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>salary</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="job.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
