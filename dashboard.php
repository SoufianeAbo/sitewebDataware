<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="./js/script.js" defer></script>
</head>
<body class = "h-screen bg-zinc-200">
    <div class = "fixed bg-gradient-to-r from-blue-600 to-blue-900 w-full z-50 md:w-1/6 md:h-full">
        <div class = "flex justify-center py-4 flex-col text-center items-center">
            <img src="./img/white3.png" alt="" class = "w-5/6 pb-2">
            <div class = "bg-blue-950 flex flex-col justify-center items-center py-4">
                <p class = "text-red-500 font-bold py-2">ADMINISTRATOR</p>

                <div class = "relative flex justify-center">
                    <img src="./img/user-solid.png" alt="" class = "absolute rounded-full bg-red-500 p-2 w-[16%] bottom-0 right-16">
                    <img src="https://intranet.youcode.ma/storage/users/profile/999-1696615417.jpg" alt="" class = "w-4/6 rounded-full border-4 border-gray-500">
                </div>

                <p class = "text-white text-sm pt-4">Abdellah Talemsi</p>
                <p class = "text-white text-sm">abdellahtalemsi@gmail.com</p>
            </div>
        </div>

        <p class = "text-white text-md py-2 pl-4 hover:bg-blue-950 transition-all cursor-pointer"><img src="./img/map-solid.png" alt="" class = "inline w-[12%] pr-2">Dashboard</p>
        <p class = "text-white text-md py-2 pl-4 hover:bg-blue-950 transition-all cursor-pointer"><img src="./img/users-solid.png" alt="" class = "inline w-[12%] pr-2">Teams</p>
        <p class = "text-white text-md py-2 pl-4 hover:bg-blue-950 transition-all cursor-pointer"><img src="./img/project-diagram-solid.png" alt="" class = "inline w-[12%] pr-2">Projects</p>
    </div>
</body>
</html>