<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedTeam = $_POST['selectedTeam'];
    $selectedMember = $_POST['selectedMember'];

    // Perform the update operation for the project
    $updateProjectSql = "UPDATE projects SET scrumMasterID = ? WHERE id = ?";
    $stmtProject = $conn->prepare($updateProjectSql);

    if ($stmtProject) {
        // Bind the parameters for the project update
        $stmtProject->bind_param("ii", $selectedMember, $selectedTeam);

        // Execute the project update statement
        $stmtProject->execute();

        // Check if the project update was successful
        if ($stmtProject->affected_rows > 0) {
            // Update successful for the project

            // Now, update projectID for all teams associated with the assigned Scrum Master
            $updateTeamsSql = "UPDATE teams SET projectID = ? WHERE scrumMasterID = ?";
            $stmtTeams = $conn->prepare($updateTeamsSql);

            if ($stmtTeams) {
                // Bind the parameters for the teams update
                $stmtTeams->bind_param("ii", $selectedTeam, $selectedMember);

                // Execute the teams update statement
                $stmtTeams->execute();

                // Check if the teams update was successful
                if ($stmtTeams->affected_rows > 0) {
                    // Update successful for teams
                    header('Location: dashboardProd.php');
                    exit;
                } else {
                    // Update failed for teams
                    echo "Error updating projectID for teams.";
                }

                // Close the teams update statement
                $stmtTeams->close();
            } else {
                // Statement preparation failed for updating teams
                echo "Error preparing SQL statement for updating teams.";
            }
        } else {
            // Update failed for the project
            echo "Error updating user's team ID.";
        }

        // Close the project update statement
        $stmtProject->close();
    } else {
        // Statement preparation failed for updating the project
        echo "Error preparing SQL statement for updating the project.";
    }
}
?>