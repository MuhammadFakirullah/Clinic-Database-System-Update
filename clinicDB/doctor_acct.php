<?php
// Start a session to manage user login state
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['doc_username'])) {
    // Redirect the user to the login page (index.php)
    header("Location: index.php");
    exit;
}

// Get the front_id of the logged-in user from the session
$logged_in_doctor_username = $_SESSION['doc_username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <!--Icons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Awesomefont Icons CSS via CDN -->
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <title>Database for Doctor</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!--Navigation bar-->
<?php include 'doctor_navbar.php'; ?>

<!-- Edit Patient Modal -->
<div class="modal fade" id="doctorEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Doctor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateDoctor" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="doc_id" id="doc_id" >

                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="doc_username" id="doc_username" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" name="doc_password" id="doc_password" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="doc_name" id="doc_name" class="form-control" required/>
                </div>

                <!-- Add input for image upload -->
                <div class="mb-3">
                    <label for="doctor_image">Image</label><br>
                    <input type="file" name="doc_image" id="doc_image" class="form-control-file" required/>
                </div>

                <!-- Display the current image if available -->
                <div class="mb-3" id="current_image_container" style="display: none;">
                    <label>Current Image</label>
                    <img id="current_image" src="" alt="Current Image" style="max-width: 100px;" />
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


<!-- View Admin Modal -->
<div class="modal fade" id="doctorViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Doctor</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Username</label>
                    <p id="view_doctor_username" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <p id="view_doctor_password" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_doctor_name" class="form-control"></p>
                </div>

                <!-- Add image container -->
                <div class="mb-3" id="view_doctor_image_container">
                    <label for="view_doctor_image">Profile Image</label><br>
                    <img id="view_doctor_image" src="" alt="Doctor Image" style="max-width: 200px;" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="doctor.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Personalize account</li>
        </ol>
    </nav>
    
    <!--Offcanvas-->
    <?php include 'doctor_offcanvas.php'; ?>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Update your info</h4>
                </div>
                <div class="card-body">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Include your database connection code (dbcon.php or equivalent)
                                require 'dbcon.php';

                                // $query = "SELECT * FROM front WHERE front_id = " . $front_id;
                                $query = "SELECT * FROM doctor WHERE doc_username = '$logged_in_doctor_username'";
                                
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $doctor) {
                                        ?>
                                        <tr>
                                            <td><?= $doctor['doc_id'] ?></td>
                                            <td><?= $doctor['doc_username'] ?></td>
                                            <td><?= $doctor['doc_password'] ?></td>
                                            <td><?= $doctor['doc_name'] ?></td>
                                            <td>
                                                <?php if (!empty($doctor['doc_image'])) { ?>
                                                    <img src="<?= $doctor['doc_image'] ?>" alt="Doctor Image" width="100">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" value="<?= $doctor['doc_id'] ?>" class="viewDoctorBtn btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                <button type="button" value="<?= $doctor['doc_id'] ?>" class="editDoctorBtn btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No Record Found</td></tr>";
                                }
                                if ($query_run === false) {
                                    echo "Query error: " . mysqli_error($con);
                                }
                                
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
        
        $(document).on('click', '.editDoctorBtn', function () {

            var doc_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code_doctor_new.php?doc_id=" + doc_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#doc_id').val(res.data.doc_id);
                        $('#doc_username').val(res.data.doc_username);
                        $('#doc_password').val(res.data.doc_password);
                        $('#doc_name').val(res.data.doc_name);
                        if (res.data.doctor_image) {
                            $('#doctor_image_preview').attr('src', res.data.doctor_image).show();
                        } else {
                            $('#doctor_image_preview').hide();
                        }
                        $('#doctorEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateDoctor', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_doctor", true);

            $.ajax({
                type: "POST",
                url: "code_doctor_new.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                        
                        $('#doctorEditModal').modal('hide');
                        $('#updateDoctor')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewDoctorBtn', function () {
            var doc_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code_doctor_new.php?doc_id=" + doc_id,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $('#view_doctor_username').text(res.data.doc_username);
                        $('#view_doctor_password').text(res.data.doc_password);
                        $('#view_doctor_name').text(res.data.doc_name);

                        // Display image if available
                        if (res.data.doc_image) {
                            $('#view_doctor_image').attr('src', res.data.doc_image);
                            $('#view_doctor_image_container').show();
                        } else {
                            $('#view_doctor_image_container').hide();
                        }

                        $('#doctorViewModal').modal('show');
                    }
                }
            });
        });

</script>

</body>
</html>
