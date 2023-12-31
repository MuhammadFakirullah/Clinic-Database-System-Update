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

<!-- Add Patient -->
<div class="modal fade" id="frontAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Front Desk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="saveFrontDesk">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="front_username" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" name="front_password" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="front_name" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Front Desk</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Patient Modal -->
<div class="modal fade" id="frontEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Front Desk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateFrontDesk">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="front_id" id="front_id" >

                <div class="mb-3">
                    <label for="">Username</label>
                    <input type="text" name="front_username" id="front_username" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="text" name="front_password" id="front_password" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="front_name" id="front_name" class="form-control" />
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Patient</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- View Patient Modal -->
<div class="modal fade" id="frontViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Front Desk</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Username</label>
                    <p id="view_front_username" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <p id="view_front_password" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_front_name" class="form-control"></p>
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
            <li class="breadcrumb-item active" aria-current="page">Front Desk</li>
        </ol>
    </nav>

    <!--Offcanvas-->
    <?php include 'admin_offcanvas.php'; ?>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Front Desk Acount
                        <button type="button" class="btn btn-primary float-end " data-bs-toggle="modal" data-bs-target="#frontAddModal">
                            <i class="fa fa-plus-circle"></i> Add Front Desk
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Search filter -->
                    <div class="col-md-7">
                        <form action="" method="GET" id="searchForm">
                            <div class="input-group mb-3">
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search data">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>

                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Name</th>
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
                                    $query = "SELECT * FROM front WHERE front_username LIKE '%$search%' OR front_password LIKE '%$search%' LIMIT $starting_record, $records_per_page";
                                } else {
                                    $query = "SELECT * FROM front LIMIT $starting_record, $records_per_page";
                                }

                                $query_run = mysqli_query($con, $query);

                                if (!$query_run) {
                                    die("Query failed: " . mysqli_error($con));
                                }

                                if (isset($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $count_query = "SELECT COUNT(*) as total FROM front WHERE front_username LIKE '%$search%' OR front_password LIKE '%$search%'";
                                } else {
                                    $count_query = "SELECT COUNT(*) as total FROM front";
                                }

                                $count_query_run = mysqli_query($con, $count_query);

                                if (!$count_query_run) {
                                    die("Query failed: " . mysqli_error($con));
                                }

                                $count_data = mysqli_fetch_assoc($count_query_run);
                                $total_records = $count_data['total'];
                                $total_pages = ceil($total_records / $records_per_page);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $front) {
                                        ?>
                                        <tr>
                                            <td><?= $front['front_id'] ?></td>
                                            <td><?= $front['front_username'] ?></td>
                                            <td><?= $front['front_password'] ?></td>
                                            <td><?= $front['front_name'] ?></td>
                                            <td>
                                                <button type="button" value="<?= $front['front_id'] ?>" class="viewFrontBtn btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                <button type="button" value="<?= $front['front_id'] ?>" class="editFrontBtn btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                                <button type="button" value="<?= $front['front_id'] ?>" class="deleteFrontBtn btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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

                    <!-- Pagination -->
                    <div class="row">
                        <div class="col-md-12">
                            <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-end">
                                <?php if ($current_page > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                        href="?page=<?= ($current_page - 1) ?>&search=<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                            Previous
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <?php
                                $max_buttons = 5; // Number of buttons to display at a time
                                $start_page = max(1, $current_page - 1); // Calculate the start page
                                $end_page = min($start_page + $max_buttons - 1, $total_pages); // Calculate the end page

                                for ($page = $start_page; $page <= $end_page; $page++) :
                                ?>
                                    <li class="page-item <?php if ($page == $current_page) echo 'active'; ?>">
                                        <a class="page-link"
                                        href="?page=<?= $page ?>&search=<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                            <?= $page ?>
                                        </a>
                                    </li>
                                <?php endfor; ?>

                                <?php if ($current_page < $total_pages) : ?>
                                    <li class="page-item">
                                        <a class="page-link"
                                        href="?page=<?= ($current_page + 1) ?>&search=<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                            Next
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
        $(document).on('submit', '#saveFrontDesk', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_front", true);

            $.ajax({
                type: "POST",
                url: "code_adminfront.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessage').addClass('d-none');
                        $('#frontAddModal').modal('hide');
                        $('#saveFront')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editFrontBtn', function () {

            var front_id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code_adminfront.php?front_id=" + front_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#front_id').val(res.data.front_id);
                        $('#front_username').val(res.data.front_username);
                        $('#front_password').val(res.data.front_password);
                        $('#front_name').val(res.data.front_name);

                        $('#frontEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updateFrontDesk', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_front", true);

            $.ajax({
                type: "POST",
                url: "code_adminfront.php",
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
                        
                        $('#frontEditModal').modal('hide');
                        $('#updateFront')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewFrontBtn', function () {

            var front_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code_adminfront.php?front_id=" + front_id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_front_username').text(res.data.front_username);
                        $('#view_front_password').text(res.data.front_password);
                        $('#view_front_name').text(res.data.front_name);

                        $('#frontViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deleteFrontBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var front_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code_adminfront.php",
                    data: {
                        'delete_front': true,
                        'front_id': front_id
                    },
                    success: function (response) {

                        var res = jQuery.parseJSON(response);
                        if(res.status == 500) {

                            alert(res.message);
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });

    </script>

</body>
</html>
