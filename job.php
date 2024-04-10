<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Serach it jobs</title>
    <style>
      
        nav {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        nav a:hover {
            text-decoration: underline;
        }

        
        h1 {
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 0 20px;
        }
        p {
            line-height: 1.6;
        }
        img { height: 200px; width: 350px; padding-left: 120px;}
        section { display: flex;}
        .wrapper { width: 600px; margin: 0 auto;}
     table tr td:last-child { width: 200px;  }
     h4 { padding-top: 20px;}.click { color:blue;}
     
</style>
<script> 
 $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

function showCongratulations() {
  var popup = document.getElementById("popup");
  popup.style.display = "block";
  
  setTimeout(function() {
    popup.style.display = "none";
  }, 2500);
}
</script>
</head>
<body>

<nav>
    <a href="index.html">Home</a>
    <a href="job.php">Research</a>
    <a href="about.html">About</a>
    <a href="Reference.html">Resources</a>

</nav>

<main class="container">
<h2> IT jobs search </h2>
<p> Researching different job roles, industries, and companies can provide valuable
       insights into the diverse range of opportunities available and help candidates align their 
       skills and interests with potential roles. Networking with professionals in the IT industry,
        attending job fairs, and leveraging online platforms such as professional networking sites
         and job boards can also be instrumental in uncovering job openings and connecting with
          potential employers. Crafting a polished resume and tailored cover letter highlighting
           relevant skills, experiences, and achievements is essential for making a strong impression
            on hiring managers. Additionally, preparing for technical interviews by brushing up on 
            key concepts, practicing coding exercises, and demonstrating problem-solving abilities 
            can significantly increase the likelihood of success in securing desired IT positions.
             Ultimately, perseverance, adaptability, and a proactive approach to learning and 
             professional development are key attributes that can empower individuals to navigate
              the complexities of the IT job search and embark on a fulfilling and rewarding 
              career journey.</p>
    <section>
    <img src="https://cdn4.vectorstock.com/i/1000x1000/30/53/find-job-logo-vector-19293053.jpg">
    <img src="https://png.pngtree.com/png-vector/20190507/ourmid/pngtree-vector-applyonline-icon-png-image_1025324.jpg">
</section>
<h4> Information technology jobs available here:</h4>
</main>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                <h1 class="pull-left">job search</h1>
                </div>
                <p class="click"> cick on the search icon for applying the following job roles below</p>

                <?php
                // Include config file
                require_once "config.php";

                // Attempt select query execution
                $sql = "SELECT * FROM jobs";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>job_name</th>";
                        echo "<th>position available</th>";
                        echo "<th>salary</th>";
                        echo "<th>changes</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['job'] . "</td>";
                            echo "<td>" . $row['position'] . "</td>";
                            echo "<td>" . $row['salary'] . "</td>";
                            echo "<td>";
                            echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                            echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                            echo '<a href="delete.php?id=' . $row['id'] . '" class="mr-3" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                           echo '<a href="javascript:void(0);" onclick="showCongratulations()"><span class="fa fa-search"></span></a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
                 <div id="popup" style="display: none;">
  <p>you have applied for this job role. </div>
                <a href="create.php" class="btn btn-dark pull-left"><i class="fa fa-plus"></i> Add New job role here</a>

            </div>
          </div>
    </div>
</div>
    </body>
</html>