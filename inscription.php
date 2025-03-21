<?php
    require_once './database/connexion.php';
if (!empty($_POST)) {
    if (
        isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['image'], $_POST['sexe'], $_POST['language'], $_POST['continent'])
        && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])  && !empty($_POST['image']) && !empty($_POST['languages']) && !empty($_POST['continent'])
    ) {

        if (strlen($_POST['name'] > 10)) {
            echo "Name should not exceed 10 characters.";
        }
        $name = htmlspecialchars(trim($_POST['name']));
        if (strlen($_POST['surname'] > 10)) {
            echo "Surname should not exceed 10 characters.";
        }

        $surname = htmlspecialchars(trim($_POST['surname']));

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format";
        }
        $email = htmlspecialchars(trim($_POST['email']));

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

var_dump($_POST['image']);









    }
}










?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Italianno&family=Parkinsans:wght@300..800&family=Playwrite+HU:wght@100..400&family=Playwrite+PE+Guides&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
    <h1 class="text-3xl font-bold pt-[100px]  text-green-500 pl-[100px] ">
        Inscrivez vous à la newsletter
    </h1>
    <form action="" method="post" enctype="multipart/form-data" class="pl-[100px]">
        <div class="flex flex-col gap-[10px]  pt-[50px]">
            <div class="flex flex-col gap-[2px]">
                <label for="name" class=" ">Enteryour name</label>
                <input type="text" name="name" id="name" class="w-[400px] border-2 border-solid border-green-500 p-[7px]" placeholder="Simo Tsebo">
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="" class="">Enter your surname</label>
                <input type="text" name="surname" id="" class="w-[400px] border-2 border-solid border-green-500 p-[7px]" placeholder="Boris Aubin">
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="email" class="">Enter your email</label>
                <input type="email" name="email" id="email" class="w-[400px] border-2 border-solid border-green-500 p-[7px]" placeholder="aubinborissimotsebo@gmail.com">
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="password" class="">Enter your password</label>
                <input type="password" name="password" id="password" class="w-[400px] border-2 border-solid border-green-500 p-[7px]" placeholder="Bafoussam@%$">
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="image" class="">Enter your image</label>
                <input type="file" name="image" id="image" class="w-[400px] border-2 border-solid border-green-500 p-[7px]" placeholder="">
            </div>

        </div>
        <div class="">
            <p class="py-[20px]">Quel est votre sexe</p>
            <div class="flex gap-[15px]">
                <label for="masculin">maxculin</label>
                <input type="radio" name="sexe" id="masculin">
                <label for="feminin">feminin</label>
                <input type="radio" name="sexe" id="feminin">
            </div>
        </div>
        <div class="pb-[20px]">
            <p class="py-[20px]">Quel est votre language preferé?</p>
            <div class="flex gap-[15px]">
                <label for="Javascript">Javascript</label>
                <input type="checkbox" name="language[ ]" id="Javascript" value="">
                <label for="Python">Python</label>
                <input type="checkbox" name="language[ ]" id="Python" value="">
                <label for="C++">C++</label>
                <input type="checkbox" name="language[ ]" id="C++" value="">
                <label for="Java">Java</label>
                <input type="checkbox" name="language[ ]" id="Java" value="">
            </div>

        </div>
        <select name="continent" id="" class="w-[400px] border-2 border-solid border-green-500 p-[7px]">
            <option value="">Choose your continent</option>
            <option value="Cameroon">Africa</option>
            <option value="France">America</option>
            <option value="Germany">Asie</option>
            <option value="USA">USA</option>
            <option value="Canada">Europe</option>


        </select><br>
        <input type="submit" name="submit" value="Envoyer" class="w-[400px] border-2 border-solid border-green-500 p-[7px] mt-[20px] bg-green-500 text-white hover:bg-green-700 cursor-pointer">
    </form>
</body>

</html>