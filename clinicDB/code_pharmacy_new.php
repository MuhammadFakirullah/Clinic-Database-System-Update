<?php

require 'dbcon.php';

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

    if (!empty($_FILES['pharmacy_image']['name'])) {
        $uploadDir = 'profileImage/'; // Directory where you want to store the images
        $targetFile = $uploadDir . basename($_FILES['pharmacy_image']['name']);
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
        if (move_uploaded_file($_FILES['pharmacy_image']['tmp_name'], $targetFile)) {
            $pharmacy_image = $targetFile;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Failed to upload the image.'
            ];
            echo json_encode($res);
            return;
        }
    }

    $query = "UPDATE pharmacy SET pharmacy_username='$pharmacy_username', pharmacy_password='$pharmacy_password', pharmacy_name='$pharmacy_name', pharmacy_image='$pharmacy_image'
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

?>