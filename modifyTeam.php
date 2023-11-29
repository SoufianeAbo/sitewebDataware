<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formName = $_POST['formName'];
    $formDescription = $_POST['formDescription'];
    $selectedModify = $_POST['selectedModify'];

    // File upload
    $uploadDir = './img/';
    $teamImage = $_FILES['teamImage'];

    $uploadPath = $uploadDir . basename($teamImage['name']);

    // Check file size and type
    if ($teamImage['size'] > 0 && $teamImage['size'] <= 10 * 1024 * 1024 && ($teamImage['type'] === 'image/jpeg' || $teamImage['type'] === 'image/png')) {
        // Check image dimensions (minimum 1152x768 pixels)
        list($width, $height) = getimagesize($teamImage['tmp_name']);
        if ($width >= 1152 && $height >= 768) {
            move_uploaded_file($teamImage['tmp_name'], $uploadPath);

            // Get projectID based on scrumMasterID from the projects table
            $scrumMasterID = $_SESSION['id'];
            $projectIDQuery = "SELECT id FROM projects WHERE scrumMasterID = ?";
            $stmtProjectID = $conn->prepare($projectIDQuery);

            $stmtProjectID->bind_param("i", $scrumMasterID);
            $stmtProjectID->execute(); 

            $stmtProjectID->bind_result($projectID);
            $stmtProjectID->fetch();
            $stmtProjectID->close();

            // Perform database operations  
            $updateSql = "UPDATE teams SET image=?, description=?, teamName=? WHERE id=?";
            $stmt = $conn->prepare($updateSql);
            $stmt->bind_param("ssss", $uploadPath, $formDescription, $formName, $selectedModify);
            $stmt->execute();
            $stmt->close();

            // Redirect to the original page or display a success message
            header('Location: dashboardScrum.php');
            exit;
        } else {
            echo 'Invalid image dimensions. Please upload an image with a minimum size of 1152x768 pixels.';
        }
    } else {
        echo 'Invalid file. Please upload a valid image file (JPEG or PNG) with a size less than 1MB.';
    }
}
?>