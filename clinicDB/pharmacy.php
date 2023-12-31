<?php
// Start a session to manage user login state
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['pharmacy_username'])) {
    // Redirect the user to the login page (index.php)
    header("Location: index.php");
    exit;
}
// Function to calculate the total number of patients
function getTotalPatientCount($con) {
    $query = "SELECT COUNT(*) as total FROM patient";
    $result = mysqli_query($con, $query);
    $count_data = mysqli_fetch_assoc($result);
    return $count_data['total'];
}

// Function to calculate the total number of patients this month
function getTotalPatientsThisMonth($con) {
    $currentMonth = date('m');
    $query = "SELECT COUNT(*) as total FROM patient WHERE MONTH(timestamp) = '$currentMonth'";
    $result = mysqli_query($con, $query);
    $count_data = mysqli_fetch_assoc($result);
    return $count_data['total'];
}

// Function to calculate the total number of patients this week
function getTotalPatientsThisWeek($con) {
    $currentDate = date('Y-m-d');
    $currentWeekStart = date('Y-m-d', strtotime('last Sunday', strtotime($currentDate)));
    $currentWeekEnd = date('Y-m-d', strtotime('next Saturday', strtotime($currentDate)));
    $query = "SELECT COUNT(*) as total FROM patient WHERE timestamp BETWEEN '$currentWeekStart' AND '$currentWeekEnd'";
    $result = mysqli_query($con, $query);
    $count_data = mysqli_fetch_assoc($result);
    return $count_data['total'];
}

// Function to calculate the total number of patients today
function getTotalPatientsToday($con) {
    $currentDate = date('Y-m-d');
    $query = "SELECT COUNT(*) as total FROM patient WHERE DATE(timestamp) = '$currentDate'";
    $result = mysqli_query($con, $query);
    $count_data = mysqli_fetch_assoc($result);
    return $count_data['total'];
}
// If the user is logged in, continue displaying the pharmacy.php content
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
    
    <!-- JQuery Datatable CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>


    <title>Database for Pharmacy</title>

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

</head>
<body>


<!--Navigation bar-->
<?php include 'pharmacy_navbar.php'; ?>

<!-- Edit Patient Modal -->
<div class="modal fade" id="patientEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Patient</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updatePatient">
            <div class="modal-body">

                <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>

                <input type="hidden" name="id" id="id" >

                <div class="mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" id="name" class="form-control" readonly/>
                </div>
                <div class="mb-3">
                    <label for="">IC number</label>
                    <input type="text" name="icno" id="icno" class="form-control" readonly/>
                </div>
                <div class="mb-3">
                    <label for="">Timestamp</label>
                    <input type="datetime-local" name="timestamp" id="timestamp" class="form-control" readonly/>
                </div>
                <div class="mb-3">
                    <label for="">Medicine prescription</label>
                    <textarea name="medicinePrescription" id="medicinePrescription" class="form-control" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Total price (RM)</label>
                    <input type="text" name="total_price" id="total_price" class="form-control"/>
                </div>
                <div class="mb-3">
                    <label for="">Payment status</label>
                    <input type="radio" name="payment_status" id="edit_payment_pending" value="Pending" /> Pending
                    <input type="radio" name="payment_status" id="edit_payment_yes" value="Paid" /> Paid
                    <input type="radio" name="payment_status" id="edit_payment_no" value="Not paid"/> Not paid
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
                    <label for="view_name">Name</label>
                    <p id="view_name" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="view_icno">IC number</label>
                    <p id="view_icno" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="view_icno">Timestamp</label>
                    <p id="view_timestamp" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="view_medicinePrescription">Medicine prescription</label>
                    <p id="view_medicinePrescription" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="view_total_price">Total price (RM)</label>
                    <p id="view_total_price" class="form-control"></p>
                </div>
                <div class="mb-3">
                    <label for="view_payment_status">Payment status</label>
                    <p id="view_payment_status" class="form-control"></p>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container mt-4">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <!--Offcanvas-->
    <?php include 'pharmacy_offcanvas.php'; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Patient Record (Pharmacy)
                    </h4>
                </div>
                <div class="card-body">

                    <!-- Patient data (card)-->
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-user" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4><?= getTotalPatientCount($con) ?></h4>
                                        <p style="font-size:14px;">Total no of patients</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-user" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4><?= getTotalPatientsThisMonth($con) ?></h4>
                                        <p style="font-size:14px;">Total no of patients this month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-user" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4><?= getTotalPatientsThisWeek($con) ?></h4>
                                        <p style="font-size:14px;">Total no of patients this week</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-user" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4><?= getTotalPatientsToday($con) ?></h4>
                                        <p style="font-size:14px;">Total no of patients today</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                    <?php
                        require 'dbcon.php';

                        $query = "select * from patient";

                        // Calculate the total of the "Total price (RM)" column based on "Paid" status
                        $totalPriceQuery = "SELECT SUM(CASE WHEN payment_status = 'Paid' THEN total_price ELSE 0 END) AS total_price_sum FROM patient";
                        $totalPriceResult = mysqli_query($con, $totalPriceQuery);

                        if ($totalPriceResult) {
                            $totalPriceData = mysqli_fetch_assoc($totalPriceResult);
                            $totalPriceSum = $totalPriceData['total_price_sum'];
                        } else {
                            $totalPriceSum = 0; // Default value in case of an error
                            //die("SQL error: " . mysqli_error($con));
                        }

                        // Calculate Gross Income for the Current Day
                        $currentDate = date('Y-m-d'); // Get the current date in Y-m-d format

                        $dayIncomeQuery = "SELECT SUM(CASE WHEN DATE(timestamp) = '$currentDate' AND payment_status = 'Paid' THEN total_price ELSE 0 END) AS day_income FROM patient";
                        $dayIncomeResult = mysqli_query($con, $dayIncomeQuery);

                        if ($dayIncomeResult) {
                            $dayIncomeData = mysqli_fetch_assoc($dayIncomeResult);
                            $dayIncome = $dayIncomeData['day_income'];
                        } else {
                            $dayIncome = 0; // Default value in case of an error
                        }

                        // Calculate Gross Income for the Current Month
                        $currentMonth = date('Y-m'); // Get the current month in Y-m format

                        $monthIncomeQuery = "SELECT SUM(CASE WHEN DATE_FORMAT(timestamp, '%Y-%m') = '$currentMonth' AND payment_status = 'Paid' THEN total_price ELSE 0 END) AS month_income FROM patient";
                        $monthIncomeResult = mysqli_query($con, $monthIncomeQuery);

                        if ($monthIncomeResult) {
                            $monthIncomeData = mysqli_fetch_assoc($monthIncomeResult);
                            $monthIncome = $monthIncomeData['month_income'];
                        } else {
                            $monthIncome = 0; // Default value in case of an error
                        }
                    ?>
                    
                    <!-- Patient data (card)-->
                    <div class="mt-4">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-dollar-sign" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4>RM <?= number_format($totalPriceSum, 2) ?></h4>
                                        <p style="font-size:14px;">Gross income</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-dollar-sign" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4>RM <?= number_format($dayIncome, 2) ?></h4>
                                        <p style="font-size:14px;">Gross income today</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-dollar-sign" style="color: #ffffff; font-size:24px;"></i>
                                        </button>
                                    </div>
                                    <div class="col-sm-9">
                                        <h4>RM <?= number_format($monthIncome, 2) ?></h4>
                                        <p style="font-size:14px;">Gross income this month</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                    <br>
                    <table id="patientTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>IC number</th>
                                <th>Timestamp</th>
                                <th>Medicine prescription</th>
                                <th>Total price (RM)</th>
                                <th>Payment status</th>
                                <th>Action</th>
                                <th>Receipt</th>
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
                                        $formattedTimestamp = date("d-m-Y H:i", strtotime($patient['timestamp']));
                                        ?>
                                        <tr>
                                            <td><?= $patient['id'] ?></td>
                                            <td><?= $patient['name'] ?></td>
                                            <td><?= $patient['icno'] ?></td>
                                            <td><?= $formattedTimestamp ?></td> <!-- Display formatted timestamp -->
                                            <td><?= $patient['medicinePrescription'] ?></td>
                                            <td><?= $patient['total_price'] ?></td>
                                            <!--<td><h6><span class="badge bg-success"><?= $patient['payment_status'] ?></span></h6></td>-->
                                            <td>
                                                <span class="badge payment-status-badge <?= ($patient['payment_status'] === 'Pending') ? 'bg-warning' : (($patient['payment_status'] === 'Not paid') ? 'bg-danger' : 'bg-success') ?>">
                                                    <?= $patient['payment_status'] ?>
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" value="<?= $patient['id'] ?>" class="viewPatientBtn btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                                                <button type="button" value="<?= $patient['id'] ?>" class="editPatientBtn btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></button>
                                                <!--<button type="button" value="<?= $patient['id'] ?>" class="deletePatientBtn btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>-->
                                            </td>
                                            <td class="text-center">
                                                <a href="generate_receipt.php?id=<?= $patient['id'] ?>" class="btn btn-success btn-sm" target="_blank">
                                                    <i class="fa fa-eye" style="color: #ffffff;"></i>
                                                </a>
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
</div>
<br>

<script>
    $('#patientTable').DataTable({
        "columnDefs": [
            {
                "targets": [1, 2, 4], // Adjust the column indices as needed
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
    // Function to update payment status badge
    function updatePaymentStatusBadge(inputElement) {
        var badge = inputElement.closest('tr').find('.payment-status-badge');
        var selectedValue = inputElement.val();
        
        badge.removeClass('bg-success bg-warning bg-danger');

        if (selectedValue === 'Paid') {
            badge.addClass('bg-success');
            // Add the total_price to the total
            $totalPriceSum += parseFloat($('#total_price').val() || 0);
        } else if (selectedValue === 'Pending') {
            badge.addClass('bg-warning');
            // You can also leave $totalPriceSum unchanged for "Pending" status
        } else if (selectedValue === 'Not paid') {
            badge.addClass('bg-danger');
            // You can also leave $totalPriceSum unchanged for "Not paid" status
        }
        // Display the updated total
        $('#totalPriceSum').text('Total Price Sum: RM ' + $totalPriceSum.toFixed(2));
    }

    // Initialize payment status badges on page load
    $('input[name="payment_status"]').each(function () {
        updatePaymentStatusBadge($(this));
    });

    // Add an event listener to the payment status radio buttons
    $('input[name="payment_status"]').change(function () {
        updatePaymentStatusBadge($(this));
    });
</script>




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
        
        $(document).on('click', '.editPatientBtn', function () {
            var id = $(this).val();

            $.ajax({
                type: "GET",
                url: "code_pharmacy.php?id=" + id,
                success: function (response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 404) {
                        alert(res.message);
                    } else if (res.status == 200) {
                        $('#id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#icno').val(res.data.icno);
                        $('#timestamp').val(res.data.timestamp);
                        $('#medicinePrescription').val(res.data.medicinePrescription);
                        $('#total_price').val(res.data.total_price);
                        $('#payment_status').val(res.data.payment_status);

                    // Set payment status radio buttons based on the retrieved data
                        if (res.data.payment_status === 'Pending') {
                            $('#edit_payment_pending').prop('checked', true);
                            $('#edit_payment_yes').prop('checked', false);
                            $('#edit_payment_no').prop('checked', false);
                        } else if (res.data.payment_status === 'Paid') {
                            $('#edit_payment_pending').prop('checked', false);
                            $('#edit_payment_yes').prop('checked', true);
                            $('#edit_payment_no').prop('checked', false);
                        } else if (res.data.payment_status === 'Not paid') {
                            $('#edit_payment_pending').prop('checked', false);
                            $('#edit_payment_yes').prop('checked', false);
                            $('#edit_payment_no').prop('checked', true);
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
                url: "code_pharmacy.php",
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
                url: "code_pharmacy.php?id=" + id,
                success: function (response) {

                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {

                        alert(res.message);
                    }else if(res.status == 200){

                        $('#view_name').text(res.data.name);
                        $('#view_icno').text(res.data.icno);
                        $('#view_timestamp').text(res.data.timestamp);
                        $('#view_medicinePrescription').text(res.data.medicinePrescription);
                        $('#view_total_price').text(res.data.total_price);
                        $('#view_payment_status').text(res.data.payment_status);

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
                    url: "code_pharmacy.php",
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


        // Add an event listener to the payment status radio buttons
        $('input[name="payment_status"]').change(function () {
            // Check if the "Paid" radio button is selected
            if ($(this).val() === 'Paid') {
                // Add the total_price to the total
                $totalPriceSum += parseFloat($('#total_price').val() || 0);
            } else {
                // Deduct the total_price from the total
                $totalPriceSum -= parseFloat($('#total_price').val() || 0);
            }

            // Display the updated total
            $('#totalPriceSum').text('Total Price Sum: RM ' + $totalPriceSum.toFixed(2));
        });

    </script>

</body>
</html>
