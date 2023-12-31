<?php
// Assuming you have set $admin_name in your login process, retrieve it from the session
$doc_name = $_SESSION['doc_name'];
$doc_username = $_SESSION['doc_username'];
$doc_password = $_SESSION['doc_password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.18.0/font/bootstrap-icons.css" rel="stylesheet">

</head>
<body>
    
  <!--Offcanvas-->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
              <div>
                  <div class="d-flex justify-content-end">
                       <button class="btn float-end" type="button" onclick="window.location.href='doctor_acct.php';">
                        <i class="fas fa-edit" style="color: #000000;"></i>
                      </button>
                  </div>
                  <h5 class="text-center"><?php echo $doc_name; ?></h5>
                  <div class="d-flex justify-content-center align-items-center mt-5">
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
                                $doctor_image = $doc_data['doc_image'];
                            } else {
                                // Admin not found
                                $doctor_image = 'profileImage/default_profile.jpg'; // Provide a default image path
                            }
                        } else {
                            echo "Error in executing the query: " . mysqli_error($con);
                        }
                        ?>

                        <img src="<?php echo $doctor_image; ?>" alt="Doctor Profile" width="120" height="130">
                  </div>
                  <!--<div class="d-flex justify-content-center align-items-center mt-3">
                      <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>Edit profile</button>
                  </div>-->
              </div>
              
              <style>
                  /* Change the accordion button height */
                  .accordion-button {
                      height: 45px; /* Adjust the height as needed */
                      border-radius: 4px;
                  }
                  /* Change the color of the accordion button icon to white */
                  .accordion-button svg {
                      fill: white;
                  }
                  /* Add a border to the accordion body */
                  .accordion-body {
                      border: 1px solid #dee2e6; /* Adjust border color as needed */
                      border-top: 0; /* Remove top border to match card-body style */
                      border-radius: 0 0 4px 4px; /* Add rounded corners to the bottom */
                      padding: 15px; /* Adjust padding as needed */
                  }
              </style>
              
              <?php
                        // Include your database connection code (dbcon.php or equivalent)
                        require 'dbcon.php';

                        // Assuming you have an SQL query to fetch admin information based on the admin's username (modify as needed)
                        $query = "SELECT * FROM doctor"; // Replace with your actual SQL query
                        $query_run = mysqli_query($con, $query);

                        if ($query_run) {
                            if (mysqli_num_rows($query_run) > 0) {
                                $doc_data = mysqli_fetch_assoc($query_run);
                                // Retrieve the admin image URL
                                $doctor_image = $doc_data['doc_image'];
                            } else {
                                // Admin not found
                                $doctor_image = 'profileImage/default_profile.jpg'; // Provide a default image path
                            }
                        } else {
                            echo "Error in executing the query: " . mysqli_error($con);
                        }
                        ?>
              
              <div class="list-group mt-3">
                  <a href="" class="list-group-item list-group-item-action active" aria-current="true">
                      <strong>Account Info</strong>
                  </a>
                  <a href="" class="list-group-item list-group-item-action">Username: <?php echo $doc_username; ?></a>
                  <a href="" class="list-group-item list-group-item-action">Password: <?php echo $doc_password; ?></a>
                  <a href="" class="list-group-item list-group-item-action">Name: <?php echo $doc_name; ?></a>
              </div>
          </div>
  </div>

  <!-- Edit Patient Modal -->
    <div class="modal fade" id="doctorEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateDoctor">
                <div class="modal-body">

                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                    <input type="hidden" name="doc_id" id="doc_id" >

                    <div class="mb-3">
                        <label for="">Username</label>
                        <input type="text" name="doc_username" id="doc_username" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="text" name="doc_password" id="doc_password" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="doc_name" id="doc_name" class="form-control" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
        </div>
    </div>
  
  </body>
</html>