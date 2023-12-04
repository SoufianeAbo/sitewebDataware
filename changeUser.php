<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'selectedRole' and 'userId' keys exist in the $_POST array
    if (isset($_POST['dropdownRole'], $_POST['userId'])) {
        // Retrieve the selected role value and user ID
        $selectedRole = $_POST['dropdownRole'];
        $userId = $_POST['userId'];

        include 'connection.php';

        // Update the 'roles' column in the 'users' table
        $sql = "UPDATE users SET role = '$selectedRole' WHERE id = $userId";

        echo $selectedRole;
        echo $userId;
        if ($conn->query($sql) === TRUE) {
            echo "User role updated successfully";
            header('Location: dashboardProd.php');
        } else {
            echo "Error updating user role: " . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // Handle the case where 'selectedRole' or 'userId' is not set
        echo "Error: Selected role or user ID not found in the form data.";
    }
} else {
    // Handle the case where the script is accessed directly without a POST request
    echo "Error: This script should be accessed via a POST request.";
}
?>