<?php
// Include your database connection code here
include 'connection.php';

// Check if the "id" parameter is set in the URL
if (isset($_GET['id'])) {
    // Retrieve the value of the "id" parameter
    $teamId = $_GET['id'];

    // Use $teamId as needed, for example, in your SQL query or any other processing
    echo "Team ID: " . $teamId;

    // Assuming you have a database connection, check if there are users in the team
    $sqlCheckUsers = "SELECT COUNT(*) AS userCount FROM users WHERE equipeID = ?";
    $stmtCheckUsers = $conn->prepare($sqlCheckUsers);
    
    if ($stmtCheckUsers) {
        $stmtCheckUsers->bind_param("i", $teamId);
        $stmtCheckUsers->execute();
        $resultCheckUsers = $stmtCheckUsers->get_result();
        $rowCheckUsers = $resultCheckUsers->fetch_assoc();
        $userCount = $rowCheckUsers['userCount'];

        // Check if there are users in the team
        if ($userCount > 0) {
            echo "Cannot delete the team. There are users in the team.";
        } else {
            // No users in the team, proceed with team deletion
            $sqlDeleteTeam = "DELETE FROM teams WHERE id = ?";
            $stmtDeleteTeam = $conn->prepare($sqlDeleteTeam);

            if ($stmtDeleteTeam) {
                $stmtDeleteTeam->bind_param("i", $teamId);
                $stmtDeleteTeam->execute();

                // Check if deletion was successful
                if ($stmtDeleteTeam->affected_rows > 0) {
                    echo "Team deleted successfully.";
                } else {
                    echo "Failed to delete the team.";
                }

                $stmtDeleteTeam->close();
            } else {
                echo "Failed to prepare delete statement.";
            }
        }

        $stmtCheckUsers->close();
    } else {
        echo "Failed to prepare check users statement.";
    }
} else {
    // Handle the case when "id" parameter is not set
    echo "Team ID not provided in the URL.";
}

// Close your database connection here
?>
