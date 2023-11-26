<?php
include 'connection.php';

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    // User is logged in
    $userId = $_SESSION['id'];
    $firstName = $_SESSION['firstName'];
    $lastName = $_SESSION['lastName'];
    $phoneNum = $_SESSION['phoneNum'];
    $role = $_SESSION['role'];
    $equipeID = $_SESSION['equipeID'];
    $email = $_SESSION['email'];
    $image = $_SESSION['image'];

} else {
    // Redirect to the login page or display an error message
    header("Location: login.php");
    exit();
}
?>