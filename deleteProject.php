<?php
// Include your database connection file here
include 'connection.php';

// Check if project ID is provided in the URL
if (isset($_GET['id'])) {
    $projectId = $_GET['id'];

    // Update team records with the same project ID to set projectID to 0
    $updateTeamsQuery = "UPDATE teams SET projectID = 0 WHERE projectID = $projectId";

    // Execute the update query
    // Note: Replace $db with your actual database connection variable
    $updateTeamsResult = mysqli_query($conn, $updateTeamsQuery);

    // Check if the team records were updated successfully
    if ($updateTeamsResult) {
        // Delete the project after updating team records
        $deleteProjectQuery = "DELETE FROM projects WHERE id = $projectId";

        // Execute the delete query
        $deleteProjectResult = mysqli_query($conn, $deleteProjectQuery);

        // Check if the project was deleted successfully
        if ($deleteProjectResult) {
            echo "Project and associated teams deleted successfully.";
        } else {
            echo "Error deleting project: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating team records: " . mysqli_error($conn);
    }
} else {
    echo "Project ID not provided.";
}
?>