<?php

require 'dbcon.php';

if(isset($_POST['save_pharmacy']))
{
    $pharmacy_username = mysqli_real_escape_string($con, $_POST['pharmacy_username']);
    $pharmacy_password = mysqli_real_escape_string($con, $_POST['pharmacy_password']);
    $pharmacy_name = mysqli_real_escape_string($con, $_POST['pharmacy_name']);

    if($pharmacy_username == NULL || $pharmacy_password == NULL || $pharmacy_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO pharmacy (pharmacy_username,pharmacy_password,pharmacy_name) VALUES ('$pharmacy_username','$pharmacy_password','$pharmacy_name')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Pharmacy Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Pharmacy Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_pharmacy']))
{
    $pharmacy_id = mysqli_real_escape_string($con, $_POST['pharmacy_id']);

    $pharmacy_username = mysqli_real_escape_string($con, $_POST['pharmacy_username']);
    $pharmacy_password = mysqli_real_escape_string($con, $_POST['pharmacy_password']);
    $pharmacy_name = mysqli_real_escape_string($con, $_POST['pharmacy_name']);
    
    if($pharmacy_username == NULL || $pharmacy_password == NULL || $pharmacy_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE pharmacy SET pharmacy_username='$pharmacy_username', pharmacy_password='$pharmacy_password', pharmacy_name='$pharmacy_name'
                WHERE pharmacy_id='$pharmacy_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Pharmacy Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Pharmacy Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['pharmacy_id']))
{
    $pharmacy_id = mysqli_real_escape_string($con, $_GET['pharmacy_id']);

    $query = "SELECT * FROM pharmacy WHERE pharmacy_id='$pharmacy_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Pharmacy Fetch Successfully by id',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Pharmacy Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_pharmacy']))
{
    $pharmacy_id = mysqli_real_escape_string($con, $_POST['pharmacy_id']);

    $query = "DELETE FROM pharmacy WHERE pharmacy_id='$pharmacy_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Pharmacy Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Pharmacy Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>