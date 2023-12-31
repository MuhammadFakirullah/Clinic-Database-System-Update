<?php

require 'dbcon.php';

if(isset($_POST['save_front']))
{
    $front_username = mysqli_real_escape_string($con, $_POST['front_username']);
    $front_password = mysqli_real_escape_string($con, $_POST['front_password']);
    $front_name = mysqli_real_escape_string($con, $_POST['front_name']);

    if($front_username == NULL || $front_password == NULL || $front_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO front (front_username,front_password,front_name) VALUES ('$front_username','$front_password','$front_name')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Front Desk Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Front Desk Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_front']))
{
    $front_id = mysqli_real_escape_string($con, $_POST['front_id']);

    $front_username = mysqli_real_escape_string($con, $_POST['front_username']);
    $front_password = mysqli_real_escape_string($con, $_POST['front_password']);
    $front_name = mysqli_real_escape_string($con, $_POST['front_name']);

    if($front_username == NULL || $front_password == NULL || $front_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE front SET front_username='$front_username', front_password='$front_password', front_name='$front_name'
                WHERE front_id='$front_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Front Desk Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Front Desk Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['front_id']))
{
    $front_id = mysqli_real_escape_string($con, $_GET['front_id']);

    $query = "SELECT * FROM front WHERE front_id='$front_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Front Desk Fetch Successfully by id',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Front Desk Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_front']))
{
    $front_id = mysqli_real_escape_string($con, $_POST['front_id']);

    $query = "DELETE FROM front WHERE front_id='$front_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Front Desk Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Front Desk Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>