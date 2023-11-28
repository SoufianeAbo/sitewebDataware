<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if userId is set in the POST data
    if (isset($_POST['userID'])) {
        $userId = $_POST['userID'];

        // Check the user's role before updating the equipeID
        $checkRoleQuery = "SELECT role FROM users WHERE id = ?";
        $stmtRole = $conn->prepare($checkRoleQuery);

        if ($stmtRole) {
            $stmtRole->bind_param("i", $userId);
            $stmtRole->execute();
            $stmtRole->bind_result($userRole);
            $stmtRole->fetch();
            $stmtRole->close();

            // Check if the user is a scrum master
            if ($userRole !== 'scrumMaster' && $userRole !== 'prodOwner') {
                // Update the user's equipeID to 0
                $updateQuery = "UPDATE users SET equipeID = 0 WHERE id = ?";
                $stmt = $conn->prepare($updateQuery);

                if ($stmt) {
                    $stmt->bind_param("i", $userId);
                    $stmt->execute();
                    $stmt->close();

                    // Redirect back to the page where the form was submitted
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit;
                } else {
                    // Handle the case where the prepared statement for the update fails
                    echo "Error in prepared statement for update.";
                }
            } else {
                // Handle the case where the user is a scrum master
                echo "Scrum masters and Product owners cannot be removed.";
                header('Refresh: 2; URL=./dashboardScrum.php');
            }
        } else {
            // Handle the case where the prepared statement for role check fails
            echo "Error in prepared statement for role check.";
        }
    } else {
        // Handle the case where userId is not set in the POST data
        echo "User ID not provided.";
    }
} else {
    // Handle the case where the request method is not POST
    echo "Invalid request method.";
}
?>
