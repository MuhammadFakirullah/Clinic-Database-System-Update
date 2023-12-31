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
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- JQuery Datatable CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    
    <title>Database for Admin</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
</head>
<body>

<!--Navigation bar-->
<?php include 'admin_navbar.php'; ?>

<!-- Add Patient -->
<div class="modal fade" id="patientAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Patient</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="savePatient" autocomplete="off">
            <div class="modal-body">

                <div id="errorMessage" class="alert alert-warning d-none"></div>

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">IC number</label>
                    <input type="text" name="icno" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Phone number</label>
                    <input type="text" name="phone_no" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Timestamps</label>
                    <input type="datetime-local" name="timestamp" id="datePicker" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <input type="radio" name="gender" id="gender_male" value="Male" /> Male
                    <input type="radio" name="gender" id="gender_female" value="Female"/> Female
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Patient</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Edit Patient Modal -->
<div class="modal fade" id="patientEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Patient</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updatePatient" autocomplete="off">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="id" id="id" >

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">IC number</label>
                    <input type="text" name="icno" id="icno" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Phone number</label>
                    <input type="text" name="phone_no" id="phone_no" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Timestamps</label>
                    <input type="datetime-local" name="timestamp" id="timestamp" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <input type="text" name="address" id="address" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <input type="radio" name="gender" id="edit_gender_male" value="Male" /> Male
                    <input type="radio" name="gender" id="edit_gender_female" value="Female"/> Female
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
<div class="modal fade" id="patientViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">View Patient</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <div class="modal-body">

                <div class="mb-3">
                    <label for="">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">IC number</label>
                    <p id="view_icno" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Phone number</label>
                    <p id="view_phone_no" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Timestamps</label>
                    <p id="view_timestamp" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Address</label>
                    <p id="view_address" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="">Gender</label>
                    <p id="view_gender"></p>
                    <p id="view_gender"></p>
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
            <li class="breadcrumb-item active" aria-current="page">Patient</li>
        </ol>
    </nav>

    <!--Offcanvas-->
    <?php include 'admin_offcanvas.php'; ?>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Patient Record (Admin)
                        <button type="button" class="btn btn-primary float-end " data-bs-toggle="modal" data-bs-target="#patientAddModal">
                            <i class="fa fa-plus-circle"></i> Add Patient
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    
                    <table id="patientTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>IC number</th>
                                <th>Phone number</th>
                                <th>Timestamps</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                // Include your database connection code (dbcon.php or equivalent)
                                require 'dbcon.php';

                                // Initialize variables
                                $query = "SELECT * FROM patient";
                                $query_run = mysqli_query($con, $query);

                                if (!$query_run) {
                                    die("Query failed: " . mysqli_error($con));
                                }

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $patient) {
                                        $formattedtimestamp = date("d-m-Y H:i", strtotime($patient['timestamp']));
                                        ?>
                                        <tr>
                                            <td><?= $patient['id'] ?></td>
                                            <td><?= $patient['name'] ?></td>
                                            <td><?= $patient['icno'] ?></td>
                                            <td><?= $patient['phone_no'] ?></td>
                                            <td><?= $formattedtimestamp ?></td>
                                            <td><?= $patient['address'] ?></td>
                                            <td><?= $patient['gender'] ?></td>
                                            <td>
                                                <button type="button" value="<?= $patient['id'] ?>" class="viewPatientBtn btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                <button type="button" value="<?= $patient['id'] ?>" class="editPatientBtn btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                                <button type="button" value="<?= $patient['id'] ?>" class="deletePatientBtn btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No Record Found</td></tr>";
                                }
                                ?>
                        </tbody>
                        <!--<tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>IC number</th>
                                <th>Phone number</th>
                                <th>Timestamps</th>
                                <th>Address</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>-->
                    </table>
                   
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<script>
    $('#patientTable').DataTable({
        "columnDefs": [
            {
                "targets": [1, 2, 3, 6], // Adjust the column indices as needed
                "render": function (data, type, row) {
                    if (type === 'display' && data.length > 10) {
                        return data.substr(0, 10) + '...';
                    }
                    return data;
                }
            }
        ]
    });
</script>

<script>
    // Get the date input element
    const datePicker = document.getElementById('datePicker');

    // Get the current date
    const currentDate = new Date();

    // Set the minimum date to today
    datePicker.min = currentDate.toISOString().split('T')[0];

    // Add an event listener to block past dates
    datePicker.addEventListener('input', function () {
        const selectedDate = new Date(this.value);
        
        if (selectedDate < currentDate) {
            // Reset the input value to the current date if a past date is selected
            this.value = currentDate.toISOString().split('T')[0];
        }
    });
</script>

<script>
    // Sample data for patient genders (replace with your data)
    var genderData = {
        labels: ["Male", "Female", "Other"],
        datasets: [{
            data: [
                <?php echo isset($gender_data['Male']) ? $gender_data['Male'] : 0; ?>,
                <?php echo isset($gender_data['Female']) ? $gender_data['Female'] : 0; ?>,
                <?php echo isset($gender_data['Other']) ? $gender_data['Other'] : 0; ?>
            ],
            backgroundColor: ["#36a2eb", "#ff6384", "#ffce56"],
        }]
    };

    // Get the canvas element for the chart
    var genderCanvas = document.getElementById("genderPieChart");

    // Create a pie chart
    var genderPieChart = new Chart(genderCanvas, {
        type: 'pie',
        data: genderData,
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
        $(document).on('submit', '#savePatient', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_patient", true);

            $.ajax({
                type: "POST",
                url: "code.php",
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
                        $('#patientAddModal').modal('hide');
                        $('#savePatient')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.editPatientBtn', function () {

            var id = $(this).val();
            
            $.ajax({
                type: "GET",
                url: "code.php?id=" + id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#icno').val(res.data.icno);
                        $('#phone_no').val(res.data.phone_no);
                        $('#timestamp').val(res.data.timestamp);
                        $('#address').val(res.data.address);
                        
                        // Check gender radio buttons based on the retrieved data
                        if (res.data.gender === 'Male') {
                            $('#edit_gender_male').prop('checked', true);
                            $('#edit_gender_female').prop('checked', false);
                        } else if (res.data.gender === 'Female') {
                            $('#edit_gender_male').prop('checked', false);
                            $('#edit_gender_female').prop('checked', true);
                        }


                        $('#patientEditModal').modal('show');
                    }

                }
            });

        });

        $(document).on('submit', '#updatePatient', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_patient", true);

            $.ajax({
                type: "POST",
                url: "code.php",
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
                        
                        $('#patientEditModal').modal('hide');
                        $('#updatePatient')[0].reset();

                        $('#myTable').load(location.href + " #myTable");

                    }else if(res.status == 500) {
                        alert(res.message);
                    }
                }
            });

        });

        $(document).on('click', '.viewPatientBtn', function () {

            var id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?id=" + id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.name);
                        $('#view_icno').text(res.data.icno);
                        $('#view_phone_no').text(res.data.phone_no);
                        $('#view_timestamp').text(res.data.timestamp);
                        $('#view_address').text(res.data.address);
                        $('#view_gender').text(res.data.gender);

                        $('#patientViewModal').modal('show');
                    }
                }
            });
        });

        $(document).on('click', '.deletePatientBtn', function (e) {
            e.preventDefault();

            if(confirm('Are you sure you want to delete this data?'))
            {
                var id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_patient': true,
                        'id': id
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
