<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class = "bg-gray-950">
    <div class = "bg-[url('./img/datawareMobile.png')] md:bg-[url('./img/datawarelogo.png')] bg-cover h-screen w-screen flex items-center justify-center md:justify-end">
        <div class = "w-5/6 rounded flex items-center justify-center flex-col md:justify-end md:w-2/6">
            <!-- <img src="./img/dataware.png" alt="Dataware Picture" class = "w-5/6"> -->
            <form class = "flex flex-col pb-4 w-5/6">
                <!-- <label for="email" class = "text-white">E-mail</label> -->
                <input type="text" name="email" id="email" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "E-mail">
                <!-- <label for="password" class = "text-white">Password</label> -->
                <input type="password" name="password" id="password" class = "border border-gray-950 p-2 mb-2 pl-4 font-bold rounded" placeholder = "Password">
                <input type="button" value="Login" class = "bg-blue-500 rounded p-2 text-white hover:bg-orange-500 transition-all cursor-pointer">
            </form>
            <a href = "" class = "text-white underline">Not registered? Click here to register</a>
        </div>
    </div>
</body>
</html>