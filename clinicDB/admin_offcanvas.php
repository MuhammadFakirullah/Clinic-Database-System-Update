<?php
// Assuming you have set $admin_name in your login process, retrieve it from the session
$admin_name = $_SESSION['admin_name'];
$admin_username = $_SESSION['admin_username'];
$admin_password = $_SESSION['admin_password'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
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
                       <button class="btn float-end" type="button" onclick="window.location.href='admin_acct.php';">
                        <i class="fas fa-edit" style="color: #000000;"></i>
                      </button>
                  </div>
                  <h5 class="text-center"><?php echo $admin_name; ?></h5>
                  <div class="d-flex justify-content-center align-items-center mt-5">
                      <?php
                        // Include your database connection code (dbcon.php or equivalent)
                        require 'dbcon.php';

                        // Assuming you have an SQL query to fetch admin information based on the admin's username (modify as needed)
                        $query = "SELECT * FROM admin"; // Replace with your actual SQL query
                        $query_run = mysqli_query($con, $query);

                        if ($query_run) {
                            if (mysqli_num_rows($query_run) > 0) {
                                $admin_data = mysqli_fetch_assoc($query_run);
                                // Retrieve the admin image URL
                                $admin_image = $admin_data['admin_image'];
                            } else {
                                // Admin not found
                                $admin_image = 'profileImage/default_profile.jpg'; // Provide a default image path
                            }
                        } else {
                            echo "Error in executing the query: " . mysqli_error($con);
                        }
                        ?>

                        <img src="<?php echo $admin_image; ?>" alt="Admin Profile" width="120" height="130">
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

              <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
                  <div class="accordion-item">
                      <h2 class="accordion-header" id="flush-headingOne">
                      <button class="accordion-button collapsed bg-primary text-light" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                          Account Info
                      </button>
                      </h2>
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">
                      
                        <?php
                            // Include your database connection code (dbcon.php or equivalent)
                            require 'dbcon.php';

                            // Assuming you have an SQL query to fetch admin records, for example:
                            $query = "SELECT * FROM admin"; // Replace with your actual SQL query
                            $query_run = mysqli_query($con, $query);

                            if ($query_run) {
                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $admin) {
                            ?>
                            <div class="admin-record">
                                <div class="admin-detail">
                                    <strong>Admin ID:</strong> <?= $admin['admin_id'] ?>
                                </div>
                                <div class="admin-detail">
                                    <strong>Admin Username:</strong> <?= $admin['admin_username'] ?>
                                </div>
                                <div class="admin-detail">
                                    <strong>Admin Password:</strong> <?= $admin['admin_password'] ?>
                                </div>
                                <div class="admin-detail">
                                    <strong>Admin Name:</strong> <?= $admin['admin_name'] ?>
                                </div>
                            </div>
                            <?php
                                    }
                                } else {
                                    echo "<p>No Records Found</p>";
                                }
                            } else {
                                echo "Error in executing the query: " . mysqli_error($con);
                            }
                            ?>
                          </div>

                      </div>
                  </div>
              </div>

              <div class="list-group mt-3">
                  <a href="admin.php" class="list-group-item list-group-item-action active" aria-current="true">
                      Home
                  </a>
                  <a href="admin_patient.php" class="list-group-item list-group-item-action">Patient Record</a>
                  <a href="admin_front.php" class="list-group-item list-group-item-action">Front Desk</a>
                  <a href="admin_doctor.php" class="list-group-item list-group-item-action">Doctor</a>
                  <a href="admin_pharmacy.php" class="list-group-item list-group-item-action">Pharmacy</a>
                  <a href="announcement.php" class="list-group-item list-group-item-action">Announcement</a>
                  <a href="admin_photo.php" class="list-group-item list-group-item-action">Gallery</a>
              </div>
          </div>
  </div>

  <!-- Edit Patient Modal -->
    <div class="modal fade" id="adminEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateAdmin">
                <div class="modal-body">

                    <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                    <input type="hidden" name="admin_id" id="admin_id" >

                    <div class="mb-3">
                        <label for="">Username</label>
                        <input type="text" name="admin_username" id="admin_username" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="text" name="admin_password" id="admin_password" class="form-control" />
                    </div>
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="admin_name" id="admin_name" class="form-control" />
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