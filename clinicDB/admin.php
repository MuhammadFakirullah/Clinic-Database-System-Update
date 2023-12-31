<?php
// Start a session to manage user login state
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['admin_username'])) {
    // Redirect the user to the login page (index.php)
    header("Location: index.php");
    exit;
}

// Require the database connection
require 'dbcon.php';

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
        <form id="savePatient">
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
        <form id="updatePatient">
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

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </nav>

    <!--Offcanvas-->
    <?php include 'admin_offcanvas.php'; ?>

    <div class="row mt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Admin Info (Dashboard)</h4>
                </div>
                <div class="card-body">

                    <?php
                        // Include your database connection code (dbcon.php or equivalent)
                        require 'dbcon.php';

                        // Get the total count of patients from the database
                        $count_query = "SELECT COUNT(*) as total FROM patient";
                        $count_query_run = mysqli_query($con, $count_query);

                        if (!$count_query_run) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        $count_data = mysqli_fetch_assoc($count_query_run);
                        $total_records = $count_data['total'];


                        // Get the total count of records from the "front" table
                        $count_query_front = "SELECT COUNT(*) as total FROM front";
                        $count_query_run_front = mysqli_query($con, $count_query_front);

                        if (!$count_query_run_front) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        $count_data_front = mysqli_fetch_assoc($count_query_run_front);
                        $total_front_records = $count_data_front['total'];


                        // Get the total count of records from the "doctor" table
                        $count_query_doctor = "SELECT COUNT(*) as total FROM doctor";
                        $count_query_run_doctor = mysqli_query($con, $count_query_doctor);

                        if (!$count_query_run_front) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        $count_data_doctor = mysqli_fetch_assoc($count_query_run_doctor);
                        $total_doctor_records = $count_data_doctor['total'];


                        // Get the total count of records from the "pharmacy" table
                        $count_query_pharmacy = "SELECT COUNT(*) as total FROM pharmacy";
                        $count_query_run_pharmacy = mysqli_query($con, $count_query_pharmacy);

                        if (!$count_query_run_front) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        $count_data_pharmacy = mysqli_fetch_assoc($count_query_run_pharmacy);
                        $total_pharmacy_records = $count_data_pharmacy['total'];

                        // Query to get the count of patients for each gender
                        $gender_query = "SELECT gender, COUNT(*) as count FROM patient GROUP BY gender";
                        $gender_query_run = mysqli_query($con, $gender_query);

                        if (!$gender_query_run) {
                            die("Query failed: " . mysqli_error($con));
                        }

                        $gender_data = array();
                        while ($row = mysqli_fetch_assoc($gender_query_run)) {
                            $gender_data[$row['gender']] = $row['count'];
                        }
                    
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

                    <!--Number of records-->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-center align-items-center">
                                    <p class="m-0">Total number of patient and staff</p>
                                </div>
                                <div class="card-body">
                                    <!--Calculate total row in database-->
                                    <div class="row">
                                            <div class="card text-white bg-primary mb-3 col-md-3 m-2" style="max-width: 18rem;">
                                                <div class="card-header">Patient</div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Patient Record</h5>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p>Total Patients: <?php echo $total_records; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card text-white bg-warning mb-3 col-md-3 m-2" style="max-width: 18rem;">
                                                <div class="card-header">Front Desk</div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Front Desk Record</h5>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p>Total Front Desk: <?php echo $total_front_records; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card text-white bg-success mb-3 col-md-3 m-2" style="max-width: 18rem;">
                                                <div class="card-header">Doctor</div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Doctor Record</h5>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p>Total Doctor: <?php echo $total_doctor_records; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card text-white bg-info mb-3 col-md-3 m-2" style="max-width: 18rem;">
                                                <div class="card-header">Pharmacy</div>
                                                <div class="card-body">
                                                    <h5 class="card-title">Pharmacy Record</h5>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p>Total Pharmacy: <?php echo $total_pharmacy_records; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Pie chart-->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-center align-items-center">
                                    <p class="m-0">Gender Distribution of Patient</p>
                                </div>
                                <center>
                                    <div class="card-body">
                                        <div style="width: 300px; height: 300px;">
                                            <canvas id="genderPieChart"></canvas>
                                        </div>
                                    </div>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-center align-items-center">
                                    <p class="m-0">Total Earnings</p>
                                </div>
                                <div class="card-body">
                                    <div class="row justify-content-center">
                                        <div class="card text-white bg-primary mb-3 col-md-6 m-2" style="max-width: 18rem;">
                                            <div class="card-header">Total Gross Income</div>
                                            <div class="card-body">
                                                <!--<h5 class="card-title">Patient Record</h5>-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>Gross Income: RM <?= number_format($totalPriceSum, 2) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card text-white bg-success mb-3 col-md-6 m-2" style="max-width: 18rem;">
                                            <div class="card-header">Gross Income Today</div>
                                            <div class="card-body">
                                                <!--<h5 class="card-title">Patient Record</h5>-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>Gross Income Current: RM <?= number_format($dayIncome, 2) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="card text-white bg-secondary  mb-3 col-md-6 m-2" style="max-width: 18rem;">
                                            <div class="card-header">Gross Income Monthly</div>
                                            <div class="card-body">
                                                <!--<h5 class="card-title">Patient Record</h5>-->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>Gross Income Current: RM <?= number_format($monthIncome, 2) ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-6 m-2" style="max-width: 18rem;">
                                            <!--<div class="card-header">Patient</div>
                                            <div class="card-body">
                                                <h5 class="card-title">Patient Record</h5>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p>Total Patients: <?php echo $total_records; ?></p>
                                                    </div>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4"></div>

</div>


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


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

</body>
</html>
