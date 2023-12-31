<?php
// Set cache control headers to prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");
session_start();

$email = $_POST['pharmacy_uname'];
$password = $_POST['pharmacy_password'];

// Database connection here
$con = new mysqli("localhost:3306", "root", "", "clinic");
if ($con->connect_error) {
    die("Failed to connect : " . $con->connect_error);
} else {
    $stmt = $con->prepare("select * from pharmacy where pharmacy_username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    if ($stmt_result->num_rows > 0) {
        $data = $stmt_result->fetch_assoc();
        if ($data['pharmacy_password'] === $password) {
            // Set a session variable to mark the user as logged in
            $_SESSION['pharmacy_username'] = $email;
            $_SESSION['pharmacy_name'] = $data['pharmacy_name']; 
            $_SESSION['pharmacy_password'] = $data['pharmacy_password'];
            header("Location: pharmacy.php");
            exit;
        } else {
            echo "<h2>Invalid email or password</h2>";
        }
    } else {
        echo "<h2>Invalid email or password</h2>";
    }
}
?>
