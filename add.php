<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedTeam = $_POST['selectedTeam'];
    $selectedMember = $_POST['selectedMember'];

    // Perform the update operation
    $updateSql = "UPDATE users SET equipeID = ? WHERE id = ?";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare($updateSql);
    
    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("ii", $selectedTeam, $selectedMember);

        // Execute the statement
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            // Update successful
            header('Location: dashboardScrum.php');
            exit;
        } else {
            // Update failed
            echo "Error updating user's team ID.";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Statement preparation failed
        echo "Error preparing SQL statement.";
    }
}
?>