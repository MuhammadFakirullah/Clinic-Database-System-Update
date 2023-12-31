<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic DB</title>
    <!--Bootstrap CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!--Icons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <!--Navigation bar-->
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
          <a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
            <i class="bi bi-grid"></i>
          </a>
          <a class="navbar-brand text-light" href="index.php">Clinic Database</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="index.php">Home</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link text-light" href="#">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="#">Pricing</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="manual.pdf" download>Manual</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="developer.php" target="_blank">Developer</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Sign in
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#adminModal">Admin</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Front Desk</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#doctorModal">Doctor</a></li>
                  <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#pharmacyModal">Pharmacy</a></li>
            
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    
      <!-- Admin Login Modal -->
      <div class="modal fade" id="adminModal" tabindex="-1" role="dialog" aria-labelledby="adminModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="adminModalLabel">Sign in (Admin)</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="admin_login.php" method="POST" autocomplete="off">
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="adminUsername" class="form-label">Username</label>
                              <input type="text" name="admin_uname" class="form-control" id="adminUsername" placeholder="Enter your username" required>
                          </div>
                          <div class="mb-3">
                              <label for="adminPassword" class="form-label">Password</label>
                              <input type="password" name="admin_password" class="form-control" id="adminPassword" placeholder="Enter your password" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <!-- Front Desk Login Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sign in (Front-Desk)</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="login.php" method="POST" autocomplete="off">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Username</label>
                        <input type="email" name="uname" class="form-control" id="exampleInputEmail1" placeholder="Enter your username" aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password" required>
                    </div>
                      
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Login</button>
                </form>

              </div>
            </div>
        </div>
      </div>

      <!-- Doctor Login Modal -->
      <div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-labelledby="doctorModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="doctorModalLabel">Sign in (Doctor)</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="doctor_login.php" method="POST" autocomplete="off">
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="doctorUsername" class="form-label">Username</label>
                              <input type="text" name="doctor_uname" class="form-control" id="doctorUsername" placeholder="Enter your username" required>
                          </div>
                          <div class="mb-3">
                              <label for="doctorPassword" class="form-label">Password</label>
                              <input type="password" name="doctor_password" class="form-control" id="doctorPassword" placeholder="Enter your password" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <!-- Pharmacy Login Modal -->
      <div class="modal fade" id="pharmacyModal" tabindex="-1" role="dialog" aria-labelledby="pharmacyModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="pharmacyModalLabel">Sign in (Pharmacy)</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="pharmacy_login.php" method="POST" autocomplete="off">
                      <div class="modal-body">
                          <div class="mb-3">
                              <label for="pharmacyUsername" class="form-label">Username</label>
                              <input type="text" name="pharmacy_uname" class="form-control" id="pharmacyUsername" placeholder="Enter your username" required>
                          </div>
                          <div class="mb-3">
                              <label for="pharmacyPassword" class="form-label">Password</label>
                              <input type="password" name="pharmacy_password" class="form-control" id="pharmacyPassword" placeholder="Enter your password" required>
                          </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>

      <!--Carousel-->
      <div id="carouselExample" class="carousel slide">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/slide1.jpg" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slide2.gif" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="img/slide3.jpg" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>

      <!--Offcanvas-->
      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasExampleLabel">About</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <div>
            The Clinic Database System is a robust and efficient software solution designed to streamline the management 
            and operations of healthcare clinics, medical practices, and healthcare facilities. It serves as a centralized 
            repository of patient and clinic information, providing healthcare professionals with the tools they need to 
            deliver high-quality patient care while optimizing administrative processes.
          </div>
          <!--
          <div class="dropdown mt-3">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
              Dropdown button
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </div> -->
        </div>
      </div>

      <!--Menu-->
      <div class="bg-warning"><br>
        <h5 class="m-0 text-center">Announcement <i class="bi-volume-up-fill" style="font-size: 24px;"></i></h5><br>
        <div class="alert alert-success m-2" role="alert">
            <?php
              // Include your database connection code (dbcon.php or equivalent)
              require 'dbcon.php';

              // Query to retrieve the 'an_text' attribute from the 'announcement' table
              $query = "SELECT an_text FROM announcement WHERE an_id = 1"; // Replace '1' with the specific announcement ID you want to retrieve

              $query_run = mysqli_query($con, $query);

              if (!$query_run) {
                  die("Query failed: " . mysqli_error($con));
              }

              if (mysqli_num_rows($query_run) > 0) {
                  $announcement = mysqli_fetch_assoc($query_run);

                  // Display the 'an_text' attribute within <p></p> tags
                  echo '<p>' . $announcement['an_text'] . '</p>';
              } else {
                  echo "No announcement found.";
              }
            ?>

        </div><br>
      </div>
      
      <!--Gallery-->
      <div class="bg-success">
          <br>
          <h5 class="m-0 text-center">Our Gallery <i class="bi bi-camera-fill" style="font-size:24px;"></i></h5>
          <br>
          <div class="row m-3">
              <?php
              // Define the directory where your images are stored
              $imageDirectory = 'uploads/';

              // Get a list of image files in the directory
              $imageFiles = glob($imageDirectory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

              if (!empty($imageFiles)) {
                  foreach ($imageFiles as $index => $imageFile) {
                      // Generate a unique image ID based on the file index
                      $imageId = $index + 1;
                      // Get the image name from the file path
                      $imageName = basename($imageFile);

                      // Output the image and modal
                      echo '<div class="col-md-2 mb-2">';
                      echo '<a href="#" data-bs-toggle="modal" data-bs-target="#imageModal' . $imageId . '">';
                      echo '<img src="' . $imageFile . '" class="rounded mx-auto d-block img-fluid" alt="' . $imageName . '" style="max-width: 200px; max-height: 200px;">';
                      echo '</a>';
                      echo '</div>';

                      // Modal for Image
                      echo '<div class="modal fade" id="imageModal' . $imageId . '" tabindex="-1" role="dialog" aria-labelledby="imageModal' . $imageId . 'Label" aria-hidden="true">';
                      echo '<div class="modal-dialog" role="document">';
                      echo '<div class="modal-content">';
                      echo '<div class="modal-body">';
                      echo '<img src="' . $imageFile . '" class="img-fluid" alt="' . $imageName . '">';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                  }
              } else {
                  echo '<p>No images found in the directory.</p>';
              }
              ?>
          </div>
          <br>
      </div>

      <!--Footer-->
      <footer class="bg-primary text-center" style="padding: 10px;">
        <div>
          <p class="m-2 text-light">&copy; 2023 Clinic Database, Inc</p>
        </div>
      </footer>
      
</body>
</html>