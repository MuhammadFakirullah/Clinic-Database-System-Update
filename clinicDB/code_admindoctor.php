<?php

require 'dbcon.php';

if(isset($_POST['save_doctor']))
{
    $doc_username = mysqli_real_escape_string($con, $_POST['doc_username']);
    $doc_password = mysqli_real_escape_string($con, $_POST['doc_password']);
    $doc_name = mysqli_real_escape_string($con, $_POST['doc_name']);

    if($doc_username == NULL || $doc_password == NULL || $doc_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "INSERT INTO doctor (doc_username,doc_password,doc_name) VALUES ('$doc_username','$doc_password','$doc_name')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Doctor Created Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Doctor Not Created'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_POST['update_doctor']))
{
    $doc_id = mysqli_real_escape_string($con, $_POST['doc_id']);

    $doc_username = mysqli_real_escape_string($con, $_POST['doc_username']);
    $doc_password = mysqli_real_escape_string($con, $_POST['doc_password']);
    $doc_name = mysqli_real_escape_string($con, $_POST['doc_name']);
    
    if($doc_username == NULL || $doc_password == NULL || $doc_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    $query = "UPDATE doctor SET doc_username='$doc_username', doc_password='$doc_password', doc_name='$doc_name'
                WHERE doc_id='$doc_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Doctor Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Doctor Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['doc_id']))
{
    $doc_id = mysqli_real_escape_string($con, $_GET['doc_id']);

    $query = "SELECT * FROM doctor WHERE doc_id='$doc_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Doctor Fetch Successfully by id',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Doctor Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

if(isset($_POST['delete_doctor']))
{
    $doc_id = mysqli_real_escape_string($con, $_POST['doc_id']);

    $query = "DELETE FROM doctor WHERE doc_id='$doc_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Doctor Deleted Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Doctor Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

?>