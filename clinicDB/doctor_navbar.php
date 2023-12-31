<?php
// Assuming you have set $admin_name in your login process, retrieve it from the session
$doc_name = $_SESSION['doc_name'];
$doc_username = $_SESSION['doc_username'];
?>
<!--Navigation bar-->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
          <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <i class="bi bi-grid"></i>
          </a>
          
          <a class="navbar-brand text-light" href="">Clinic Database</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <!-- <li class="nav-item"> 
                <a class="nav-link active text-light" aria-current="page" href="manual.pdf" download>Manual</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="developer.php" target="_blank">Developer</a>
              </li> -->
            </ul>
            <!-- Move Logout button to the left -->
            <ul class="navbar-nav ml-auto custom-nav">
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="">
                        <?php
                        // Include your database connection code (dbcon.php or equivalent)
                        require 'dbcon.php';

                        // Assuming you have an SQL query to fetch admin information based on the admin's username (modify as needed)
                        $query = "SELECT * FROM doctor where doc_username = '$doc_username'"; // Replace with your actual SQL query
                        $query_run = mysqli_query($con, $query);

                        if ($query_run) {
                            if (mysqli_num_rows($query_run) > 0) {
                                $doc_data = mysqli_fetch_assoc($query_run);
                                // Retrieve the admin image URL
                                $doc_image = $doc_data['doc_image'];
                            } else {
                                // Admin not found
                                $doc_image = 'profileImage/default_profile.jpg'; // Provide a default image path
                            }
                        } else {
                            echo "Error in executing the query: " . mysqli_error($con);
                        }
                        ?>
                        <img src="<?php echo $doc_image; ?>" alt="Doctor image" width="25" height="25">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-light" aria-current="page" href="">
                        <?php echo $doc_name; ?>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active text-light" aria-current="page" href="logout_doctor.php"><i class="fas fa-door-open"></i> Log out
                </a>
                </li>
            </ul>
          </div>
        </div>
</nav>
<style>
  /* Custom CSS to move the "Sign in" dropdown to the right */
  .custom-nav {
    margin-left: auto;
  }
</style>