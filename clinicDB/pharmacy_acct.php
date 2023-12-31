<?php
// Start a session to manage user login state
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['pharmacy_username'])) {
    // Redirect the user to the login page (index.php)
    header("Location: index.php");
    exit;
}

// Get the front_id of the logged-in user from the session
$logged_in_pharmacy_username = $_SESSION['pharmacy_username'];
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
    
    <title>Database for Pharmacy</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!--Navigation bar-->
<?php include 'pharmacy_navbar.php'; ?>

<!-- Edit Patient Modal -->
<div class="modal fade" id="pharmacyEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Pharmacy</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updatePharmacy" enctype="multipart/form-data" autocomplete="off">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="pharmacy_id" id="pharmacy_id" >

                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="pharmacy_username" id="pharmacy_username" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" name="pharmacy_password" id="pharmacy_password" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="pharmacy_name" id="pharmacy_name" class="form-control" required/>
                </div>

                <!-- Add input for image upload -->
                <div class="mb-3">
                    <label for="pharmacy_image">Image</label><br>
                    <input type="file" name="pharmacy_image" id="pharmacy_image" class="form-control-file" required/>
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
<div class="modal fade" id="pharmacyViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Pharmacy</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Username</label>
                    <p id="view_pharmacy_username" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <p id="view_pharmacy_password" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_pharmacy_name" class="form-control"></p>
                </div>

                <!-- Add image container -->
                <div class="mb-3" id="view_pharmacy_image_container">
                    <label for="view_pharmacy_image">Profile Image</label><br>
                    <img id="view_pharmacy_image" src="" alt="Pharmacy Image" style="max-width: 200px;" />
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
            <li class="breadcrumb-item"><a href="pharmacy.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Personalize account</li>
        </ol>
    </nav>
    
    <!--Offcanvas-->
    <?php include 'pharmacy_offcanvas.php'; ?>

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
                                $query = "SELECT * FROM pharmacy WHERE pharmacy_username = '$logged_in_pharmacy_username'";
                                
                                $query_run = mysqli_query($con, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $pharmacy) {
                                        ?>
                                        <tr>
                                            <td><?= $pharmacy['pharmacy_id'] ?></td>
                                            <td><?= $pharmacy['pharmacy_username'] ?></td>
                                            <td><?= $pharmacy['pharmacy_password'] ?></td>
                                            <td><?= $pharmacy['pharmacy_name'] ?></td>
                                            <td>
                                                <?php if (!empty($pharmacy['pharmacy_image'])) { ?>
                                                    <img src="<?= $pharmacy['pharmacy_image'] ?>" alt="Pharmacy Image" width="100">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" value="<?= $pharmacy['pharmacy_id'] ?>" class="viewPharmacyBtn btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                <button type="button" value="<?= $pharmacy['pharmacy_id'] ?>" class="editPharmacyBtn btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
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
        
        $(document).on('click', '.editPharmacyBtn', function () {

            var pharmacy_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code_pharmacy_new.php?pharmacy_id=" + pharmacy_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#pharmacy_id').val(res.data.pharmacy_id);
                        $('#pharmacy_username').val(res.data.pharmacy_username);
                        $('#pharmacy_password').val(res.data.pharmacy_password);
                        $('#pharmacy_name').val(res.data.pharmacy_name);
                        if (res.data.pharmacy_image) {
                            $('#pharmacy_image_preview').attr('src', res.data.pharmacy_image).show();
                        } else {
                            $('#pharmacy_image_preview').hide();
                        }
                        $('#pharmacyEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updatePharmacy', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_pharmacy", true);

            $.ajax({
                type: "POST",
                url: "code_pharmacy_new.php",
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
                        
                        $('#pharmacyEditModal').modal('hide');
                        $('#updatePharmacy')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewPharmacyBtn', function () {
            var pharmacy_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code_pharmacy_new.php?pharmacy_id=" + pharmacy_id,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $('#view_pharmacy_username').text(res.data.pharmacy_username);
                        $('#view_pharmacy_password').text(res.data.pharmacy_password);
                        $('#view_pharmacy_name').text(res.data.pharmacy_name);

                        // Display image if available
                        if (res.data.pharmacy_image) {
                            $('#view_pharmacy_image').attr('src', res.data.pharmacy_image);
                            $('#view_pharmacy_image_container').show();
                        } else {
                            $('#view_pharmacy_image_container').hide();
                        }

                        $('#pharmacyViewModal').modal('show');
                    }
                }
            });
        });

</script>

</body>
</html>
