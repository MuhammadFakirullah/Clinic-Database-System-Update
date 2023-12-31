<?php

require 'dbcon.php';

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

    if (!empty($_FILES['doc_image']['name'])) {
        $uploadDir = 'profileImage/'; // Directory where you want to store the images
        $targetFile = $uploadDir . basename($_FILES['doc_image']['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if the uploaded file is an image
        $validExtensions = array('jpg', 'jpeg', 'png', 'gif');
        if (!in_array($imageFileType, $validExtensions)) {
            $res = [
                'status' => 422,
                'message' => 'Only JPG, JPEG, PNG, and GIF files are allowed.'
            ];
            echo json_encode($res);
            return;
        }

        // Upload the image
        if (move_uploaded_file($_FILES['doc_image']['tmp_name'], $targetFile)) {
            $doc_image = $targetFile;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Failed to upload the image.'
            ];
            echo json_encode($res);
            return;
        }
    }

    $query = "UPDATE doctor SET doc_username='$doc_username', doc_password='$doc_password', doc_name='$doc_name', doc_image='$doc_image'
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

?>