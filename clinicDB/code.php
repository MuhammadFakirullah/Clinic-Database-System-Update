<?php

require 'dbcon.php';

if(isset($_POST['save_patient']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $icno = mysqli_real_escape_string($con, $_POST['icno']);
    $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
    $timestamp = mysqli_real_escape_string($con, $_POST['timestamp']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);

    if($name == NULL || $icno == NULL || $phone_no == NULL || $timestamp == NULL || $address == NULL || $gender == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO patient (name,icno,phone_no,timestamp,address,gender) VALUES ('$name','$icno','$phone_no','$timestamp','$address','$gender')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Patient Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $error_message = mysqli_error($con);
        $res = [
            'status' => 500,
            'message' => 'Patient Not Created' . $error_message
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_patient']))
{
    $id = mysqli_real_escape_string($con, $_POST['id']);

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $icno = mysqli_real_escape_string($con, $_POST['icno']);
    $phone_no = mysqli_real_escape_string($con, $_POST['phone_no']);
    $timestamp = mysqli_real_escape_string($con, $_POST['timestamp']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $gender = mysqli_real_escape_string($con, $_POST['gender']);

    if($name == NULL || $icno == NULL || $phone_no == NULL || $timestamp == NULL || $address == NULL || $gender == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE patient SET name='$name', icno='$icno', phone_no='$phone_no', timestamp='$timestamp', address='$address', gender='$gender' 
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