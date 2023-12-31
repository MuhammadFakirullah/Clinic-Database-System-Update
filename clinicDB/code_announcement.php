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


if(isset($_POST['update_announcement']))
{
    $an_id = mysqli_real_escape_string($con, $_POST['an_id']);

    $an_text = mysqli_real_escape_string($con, $_POST['an_text']);
    
    if($an_text == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE announcement SET an_text='$an_text' WHERE an_id='$an_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Announcement Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Announcement Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['an_id']))
{
    $an_id = mysqli_real_escape_string($con, $_GET['an_id']);

    $query = "SELECT * FROM announcement WHERE an_id='$an_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Announcement Fetch Successfully by id',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Announcement Id Not Found'
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