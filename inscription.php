<?php

require_once './database/connexion.php';

if (!empty($_POST)) {
    echo "hey";

    if (
        isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_POST['sexe'], $_POST['language'], $_POST["continent"], $_FILES['image']) &&
        !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password'])
    ) {
        if (strlen($_POST['name']) > 20) {
            die("Name should not exceed 20 characters.");
        }

        $name = htmlspecialchars($_POST['name']);

        if (strlen($_POST['surname']) > 20) {
            die("Surname should not exceed 20 characters.");
        }

        $surname = htmlspecialchars(trim($_POST['surname']));

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format");
        }

        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        if (!isset($_POST['sexe'])) {
            die("Please select your sexe");
        }

        $sexe = $_POST['sexe'];
        if (!isset($_POST['language'])) {
            die("Please select your language");
        }
        $language = implode(" ", $_POST['language']);
        if (!isset($_POST['continent'])) {
            die("Please select your continent");
        }
        $continent = $_POST['continent'];
        if ($_FILES['image']['error'] == 0) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_size = $_FILES['image']['size'];
            $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

            $allowed_extensions = ['jpg', 'jpeg', 'png'];

            // Vérification de l'extension
            if (!in_array($image_extension, $allowed_extensions)) {
                die("❌ Format d'image invalide. Formats autorisés : JPG, JPEG, PNG.");
            }

            // Vérification de la taille (max 3 Mo)
            if ($image_size > 3 * 1024 * 1024) {
                die("❌ L'image ne doit pas dépasser 3 Mo.");
            }

            // Lecture du fichier en binaire
            $image = file_get_contents($image_tmp);

            // Affichage pour vérification (supprimer en production)
            echo "✅ Image valide et prête à être stockée.";
        } else {
            die("❌ Erreur lors de l'envoi de l'image.");
        }


        // $sql = "INSERT INTO `users` (`name`, `surname`, `email`, `password`, `images`,`sexe`, `language`, `continent`)
        //         VALUES (:name, :surname, :email, :password, :images, :sexe, :language, :continent)";
        $sql = "INSERT INTO users (name, surname, email, password,images, sexe, language,continent ) 
        VALUES (:name, :surname, :email, :password,:image, :sexe, :language, :continent )";
        $requete = $db->prepare($sql);
        // $requete->bindValue(':name', $name, PDO::PARAM_STR);
        // $requete->bindValue(':surname', $surname, PDO::PARAM_STR);
        // $requete->bindValue(':email', $email, PDO::PARAM_STR);
        // $requete->bindValue(':password', $password, PDO::PARAM_STR);
        // $requete->bindValue(':images', $image, PDO::PARAM_LOB);  // PDO::PARAM_LOB pour blob (Binary Large OBject)
        // $requete->bindValue(':sexe', $sexe, PDO::PARAM_STR);
        // $requete->bindValue(":language", $language, PDO::PARAM_STR);
        // $requete->bindValue(':continent', $continent, PDO::PARAM_STR);
        $requete->bindValue(":name", $name, PDO::PARAM_STR);
        $requete->bindValue(":surname", $surname, PDO::PARAM_STR);
        $requete->bindValue(":email", $email, PDO::PARAM_STR);
        $requete->bindValue(":password", $password, PDO::PARAM_STR);
        $requete->bindValue(":image", $image, PDO::PARAM_LOB);
        $requete->bindValue(":sexe", $sexe);
        $requete->bindValue(":language", $language);
        $requete->bindValue(":continent", $continent);
        // $requete->execute();
        if ($requete->execute()) {
            echo "Inscription réussie";
        } else {
            echo "Erreur lors de l'inscription";
        }
        header("location:connexion.php");
    } else {
        echo "Veuillez remplir tous les champs";
    }
}

?>






<?php
require_once './require/header.php';
?>


    <div class="flex justify-center items-center pt-[100px] gap-[15px]">
        <h1 class="text-3xl font-bold  text-green-500 pl-[100px] ">
            Inscrivez vous à la newsletter
        </h1>
        <p class="text-3xl font-bold  text-green-500 "><a href="table.php">Listes des utilisateurs</a></p>
    </div>
    <form action="" method="post" enctype="multipart/form-data" class="pl-[100px] flex justify-center items-center">
        <div class="grid grid-cols-2  pt-[50px] max-w-[800px] gap-[20px]">
            <div class="flex flex-col gap-[2px]">
                <label for="name" class=" ">Enter your name</label>
                <input type="text" required name="name" id="name" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="Simo Tsebo">
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="" class="">Enter your surname</label>
                <input type="text" name="surname" id="" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="Boris Aubin" required>
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="email" class="">Enter your email</label>
                <input type="email" name="email" id="email" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="aubinborissimotsebo@gmail.com" required>
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="password" class="">Enter your password</label>
                <input type="password" name="password" id="password" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="Bafoussam@%$" required>
            </div>
            <div class="flex flex-col gap-[2px]">
                <label for="image" class="">Enter your image</label>
                <input type="file" name="image" id="image" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="" required>
            </div>


            <div class="">
                <p class="pt-[20px]">Quel est votre sexe</p>
                <div class="flex gap-[15px]">
                    <label for="masculin">maxculin</label>
                    <input type="radio" name="sexe" id="masculin" value="masculin">
                    <label for="feminin">feminin</label>
                    <input type="radio" name="sexe" id="feminin" value="feminin">
                </div>
            </div>

            <div class="">
                <p class="py-[20px]">Quel est votre language preferé?</p>
                <div class="flex gap-[15px]">
                    <label for="Javascript">Javascript</label>
                    <input type="checkbox" name="language[ ]" id="Javascript" value="Javascript">
                    <label for="Python">Python</label>
                    <input type="checkbox" name="language[ ]" id="Python" value="Python">
                    <label for="C++">C++</label>
                    <input type="checkbox" name="language[ ]" id="C++" value="C++">
                    <label for="Java">Java</label>
                    <input type="checkbox" name="language[ ]" id="Java" value="Java">
                </div>

            </div>

            <select name="continent" id="" class="w-[300px] border-2 border-solid border-green-500 p-[7px]">
                <option value="">Choose your continent</option>
                <option value="Cameroon">Africa</option>
                <option value="France">America</option>
                <option value="Germany">Asie</option>
                <option value="USA">USA</option>
                <option value="Canada">Europe</option>


            </select>
            <br>
            <input type="submit" name="submit" value="Envoyer" class="w-[300px] border-2 border-solid border-green-500 p-[7px] mt-[20px] bg-green-500 text-white hover:bg-green-700 cursor-pointer">
        </div>
    </form>
    <?php
require_once "./require/footer.php";
?>