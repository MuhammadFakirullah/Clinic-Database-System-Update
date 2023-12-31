<?php

require 'dbcon.php';


if(isset($_POST['update_patient']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $icno = mysqli_real_escape_string($con, $_POST['icno']);
    $diagnose_status = mysqli_real_escape_string($con, $_POST['diagnose_status']);
    $appointment_status = mysqli_real_escape_string($con, $_POST['appointment_status']);
    $appointmentDateTime = mysqli_real_escape_string($con, $_POST['appointmentDateTime']);
    $medicinePrescription = mysqli_real_escape_string($con, $_POST['medicinePrescription']);

    if($name == NULL || $icno == NULL || $diagnose_status == NULL || $appointment_status == NULL || $appointmentDateTime == NULL || $medicinePrescription == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE patient SET name='$name', icno='$icno', diagnose_status='$diagnose_status', appointment_status='$appointment_status', appointmentDateTime='$appointmentDateTime', medicinePrescription='$medicinePrescription' 
                WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Patient Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Patient Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['id']))
{
    $id = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM patient WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Patient Fetch Successfully by id',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Patient Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_patient']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $query = "DELETE FROM patient WHERE id='$id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Patient Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Patient Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>