<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];
    $password = $_POST["password"];

    // Upload team image (You may want to enhance this part for better security and validation)
    $uploadDir = './img/';
    $teamImage = $_FILES['teamImage'];

    $uploadPath = $uploadDir . basename($teamImage['name']);
    $role = "user";

    move_uploaded_file($teamImage['tmp_name'], $uploadPath);

    // Insert user information into the database without hashing the password
    $stmt = $conn->prepare("INSERT INTO users (image, firstName, lastName, email, phoneNum, pass, role, equipeID) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
    $stmt->bind_param("sssssss", $uploadPath, $firstName, $lastName, $email, $phoneNumber, $password, $role);
    $stmt->execute();

    // Log in the user after successful registration
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if ($password === $row['pass']) {
            // Start a session and store user information
            $_SESSION['id'] = $row['id'];
            $_SESSION['image'] = $row['image'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phoneNum'] = $row['phoneNum'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['equipeID'] = $row['equipeID'];

            // Redirect to the dashboard page
            if ($_SESSION['role'] == 'user') {
                header("Location: dashboardUser.php");
                exit();
            } else if ($_SESSION['role'] == 'scrumMaster') {
                header("Location: dashboardScrum.php");
                exit();
            } else if ($_SESSION['role'] == 'prodOwner') {
                header("Location: dashboardProd.php");
                exit();
            }
        } else {
            echo "<p class='text-red-300'>Invalid username or password.</p>";
        }
    } else {
        echo "<p class='text-red-300'>Registration failed.</p>";
    }
}
?>