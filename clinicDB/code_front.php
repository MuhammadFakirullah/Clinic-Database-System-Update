<?php

require 'dbcon.php';

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

    if (!empty($_FILES['front_image']['name'])) {
        $uploadDir = 'profileImage/'; // Directory where you want to store the images
        $targetFile = $uploadDir . basename($_FILES['front_image']['name']);
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
        if (move_uploaded_file($_FILES['front_image']['tmp_name'], $targetFile)) {
            $front_image = $targetFile;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Failed to upload the image.'
            ];
            echo json_encode($res);
            return;
        }
    }

    $query = "UPDATE front SET front_username='$front_username', front_password='$front_password', front_name='$front_name', front_image='$front_image'
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

?>