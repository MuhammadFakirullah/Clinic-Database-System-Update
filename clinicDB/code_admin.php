<?php

require 'dbcon.php';

if(isset($_POST['update_admin']))
{
    $admin_id = mysqli_real_escape_string($con, $_POST['admin_id']);

    $admin_username = mysqli_real_escape_string($con, $_POST['admin_username']);
    $admin_password = mysqli_real_escape_string($con, $_POST['admin_password']);
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']);
    
    if($admin_username == NULL || $admin_password == NULL || $admin_name == NULL)
    {
        $res = [
            'status' => 422,
            'message' => 'All fields are mandatory'
        ];
        echo json_encode($res);
        return;
    }

    if (!empty($_FILES['admin_image']['name'])) {
        $uploadDir = 'profileImage/'; // Directory where you want to store the images
        $targetFile = $uploadDir . basename($_FILES['admin_image']['name']);
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
        if (move_uploaded_file($_FILES['admin_image']['tmp_name'], $targetFile)) {
            $admin_image = $targetFile;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Failed to upload the image.'
            ];
            echo json_encode($res);
            return;
        }
    }

    $query = "UPDATE admin SET admin_username='$admin_username', admin_password='$admin_password', admin_name='$admin_name', admin_image='$admin_image'
                WHERE admin_id='$admin_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Admin Updated Successfully'
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 500,
            'message' => 'Admin Not Updated'
        ];
        echo json_encode($res);
        return;
    }
}


if(isset($_GET['admin_id']))
{
    $admin_id = mysqli_real_escape_string($con, $_GET['admin_id']);

    $query = "SELECT * FROM admin WHERE admin_id='$admin_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $patient = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'message' => 'Admin Fetch Successfully by id',
            'data' => $patient
        ];
        echo json_encode($res);
        return;
    }
    else
    {
        $res = [
            'status' => 404,
            'message' => 'Admin Id Not Found'
        ];
        echo json_encode($res);
        return;
    }
}

?>