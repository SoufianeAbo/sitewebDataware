<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/script.js" defer></script>
</head>
<body class = "bg-gray-950">
    <div class = "bg-[url('./img/datawareMobile.png')] md:bg-[url('./img/datawarelogo.png')] bg-cover h-screen w-screen flex items-center justify-center md:justify-end">
        <div class = "w-5/6 rounded flex items-center justify-center flex-col md:justify-end md:w-2/6" id = "formLogin">
            <!-- <img src="./img/dataware.png" alt="Dataware Picture" class = "w-5/6"> -->
            <form class = "flex flex-col pb-4 w-5/6" method = "POST">
                <!-- <label for="email" class = "text-white">E-mail</label> -->
                <input type="text" name="email" id="email" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "E-mail" required>
                <!-- <label for="password" class = "text-white">Password</label> -->
                <input type="password" name="password" id="password" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "Password" required>
                <input type="submit" value="Submit" class = "bg-blue-500 rounded p-2 text-white hover:bg-orange-500 transition-all cursor-pointer">
            </form>
            <?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the hashed password
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
            echo "<p class = 'text-red-300'>Invalid username or password.</p>";
        }
    } else {
        echo "<p class = 'text-red-300'>Invalid username or password.</p>";
    }
}

?>
            <a href = "#" class = "text-white underline" id = "registerLink">Not registered? Click here to register</a>
        </div>

        <div class = "w-5/6 rounded flex items-center justify-center flex-col md:justify-end md:w-2/6 hidden" id = "formRegister">
            <!-- <img src="./img/dataware.png" alt="Dataware Picture" class = "w-5/6"> -->
            <form class = "flex flex-col pb-4 w-5/6" method = "POST">
                <!-- <label for="email" class = "text-white">E-mail</label> -->
                <input type="text" name="firstName" id="firstName" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "First Name" required>
                <input type="text" name="lastName" id="lastName" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "Last Name" required>
                <input type="text" name="email" id="email" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "E-mail" required>
                <input type="text" name="phoneNumber" id="phoneNumber" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "Phone Number" required>
                <!-- <label for="password" class = "text-white">Password</label> -->
                <input type="password" name="password" id="password" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "Password" required>
                <input type="button" value="Register" class = "bg-blue-500 rounded p-2 text-white hover:bg-orange-500 transition-all cursor-pointer">
            </form>
            <a href = "#" class = "text-white underline" id = "loginLink">Already have an account? Click here to login</a>
        </div>
    </div>
</body>
</html>