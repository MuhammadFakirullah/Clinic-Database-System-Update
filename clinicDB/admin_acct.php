<?php
// Start a session to manage user login state
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['admin_username'])) {
    // Redirect the user to the login page (index.php)
    header("Location: index.php");
    exit;
}
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
    
    <title>Database for Admin</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!--Navigation bar-->
<?php include 'admin_navbar.php'; ?>

<!-- Edit Patient Modal -->
<div class="modal fade" id="adminEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateAdmin" enctype="multipart/form-data">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="admin_id" id="admin_id" >

                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="admin_username" id="admin_username" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" name="admin_password" id="admin_password" class="form-control" required/>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="admin_name" id="admin_name" class="form-control" required/>
                </div>

                <!-- Add input for image upload -->
                <div class="mb-3">
                    <label for="admin_image">Image</label><br>
                    <input type="file" name="admin_image" id="admin_image" class="form-control-file" required/>
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
<div class="modal fade" id="adminViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Username</label>
                    <p id="view_admin_username" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <p id="view_admin_password" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_admin_name" class="form-control"></p>
                </div>

                <!-- Add image container -->
                <div class="mb-3" id="view_admin_image_container">
                    <label for="view_admin_image">Profile Image</label><br>
                    <img id="view_admin_image" src="" alt="Admin Image" style="max-width: 200px;" />
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
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Personalize account</li>
        </ol>
    </nav>
    
    <!--Offcanvas-->
    <?php include 'admin_offcanvas.php'; ?>

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

                                // Initialize variables
                                $records_per_page = 5;
                                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $starting_record = ($current_page - 1) * $records_per_page;

                                if (isset($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $query = "SELECT * FROM admin WHERE admin_username LIKE '%$search%' OR admin_password LIKE '%$search%' LIMIT $starting_record, $records_per_page";
                                } else {
                                    $query = "SELECT * FROM admin LIMIT $starting_record, $records_per_page";
                                }

                                $query_run = mysqli_query($con, $query);

                                if (!$query_run) {
                                    die("Query failed: " . mysqli_error($con));
                                }

                                if (isset($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $count_query = "SELECT COUNT(*) as total FROM admin WHERE admin_username LIKE '%$search%' OR admin_password LIKE '%$search%'";
                                } else {
                                    $count_query = "SELECT COUNT(*) as total FROM admin";
                                }

                                $count_query_run = mysqli_query($con, $count_query);

                                if (!$count_query_run) {
                                    die("Query failed: " . mysqli_error($con));
                                }

                                $count_data = mysqli_fetch_assoc($count_query_run);
                                $total_records = $count_data['total'];
                                $total_pages = ceil($total_records / $records_per_page);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $admin) {
                                        ?>
                                        <tr>
                                            <td><?= $admin['admin_id'] ?></td>
                                            <td><?= $admin['admin_username'] ?></td>
                                            <td><?= $admin['admin_password'] ?></td>
                                            <td><?= $admin['admin_name'] ?></td>
                                            <td>
                                                <?php if (!empty($admin['admin_image'])) { ?>
                                                    <img src="<?= $admin['admin_image'] ?>" alt="Admin Image" width="100">
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <button type="button" value="<?= $admin['admin_id'] ?>" class="viewAdminBtn btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                <button type="button" value="<?= $admin['admin_id'] ?>" class="editAdminBtn btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No Record Found</td></tr>";
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
        
        $(document).on('click', '.editAdminBtn', function () {

            var admin_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code_admin.php?admin_id=" + admin_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#admin_id').val(res.data.admin_id);
                        $('#admin_username').val(res.data.admin_username);
                        $('#admin_password').val(res.data.admin_password);
                        $('#admin_name').val(res.data.admin_name);
                        if (res.data.admin_image) {
                            $('#admin_image_preview').attr('src', res.data.admin_image).show();
                        } else {
                            $('#admin_image_preview').hide();
                        }
                        $('#adminEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateAdmin', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_admin", true);

            $.ajax({
                type: "POST",
                url: "code_admin.php",
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
                        
                        $('#adminEditModal').modal('hide');
                        $('#updateAdmin')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewAdminBtn', function () {
            var admin_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code_admin.php?admin_id=" + admin_id,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $('#view_admin_username').text(res.data.admin_username);
                        $('#view_admin_password').text(res.data.admin_password);
                        $('#view_admin_name').text(res.data.admin_name);

                        // Display image if available
                        if (res.data.admin_image) {
                            $('#view_admin_image').attr('src', res.data.admin_image);
                            $('#view_admin_image_container').show();
                        } else {
                            $('#view_admin_image_container').hide();
                        }

                        $('#adminViewModal').modal('show');
                    }
                }
            });
        });

    </script>

</body>
</html>
