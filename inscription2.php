<?php
require_once './database/connexion.php';

if (!empty($_POST)) {
    echo "hey";
    
    if (
        isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password'], $_FILES['image'], $_POST['sexe'], $_POST['language'], $_POST['continent'])
        && !empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['sexe']) && !empty($_POST['language']) && !empty($_POST['continent'])
    ) {
        
        if (strlen($_POST['name']) > 10) {
            die("Name should not exceed 10 characters.");
        }
        $name = htmlspecialchars(trim($_POST['name']));
        
        if (strlen($_POST['surname']) > 10) {
            die("Surname should not exceed 10 characters.");
        }
        $surname = htmlspecialchars(trim($_POST['surname']));
        
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            die("Invalid email format");
        }
        $email = htmlspecialchars(trim($_POST['email']));

        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sexe = htmlspecialchars(trim($_POST['sexe']));
        
        $language = implode(',', $_POST['language']);
        $continent = htmlspecialchars(trim($_POST['continent']));
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $image_name = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $image_size = $_FILES['image']['size'];
            $image_extension = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            
            $allowed_extensions = ['jpg', 'jpeg', 'png'];
            if (!in_array($image_extension, $allowed_extensions)) {
                die("Invalid image format. Allowed formats: JPG, JPEG, PNG.");
            }
            
            if ($image_size > 3 * 1024 * 1024) {
                die("L'image ne doit pas dépasser 3 Mo.");
            }
            
            $image_data = file_get_contents($image_tmp);
        } else {
            die("Error uploading image.");
        }
        
        $sql = "INSERT INTO users (name, surname, email, password, images, sexe, language, continent) 
                VALUES (:name, :surname, :email, :password, :images, :sexe, :language, :continent)";
        
        $requete = $db->prepare($sql);
        $requete->bindValue(':name', $name, PDO::PARAM_STR);
        $requete->bindValue(':surname', $surname, PDO::PARAM_STR);
        $requete->bindValue(':email', $email, PDO::PARAM_STR);
        $requete->bindValue(':password', $password, PDO::PARAM_STR);
        $requete->bindValue(':images', $image_data, PDO::PARAM_LOB);
        $requete->bindValue(':sexe', $sexe, PDO::PARAM_STR);
        $requete->bindValue(':language', $language, PDO::PARAM_STR);
        $requete->bindValue(':continent', $continent, PDO::PARAM_STR);
        
        if ($requete->execute()) {
            echo "Inscription réussie";
        } else {
            echo "Erreur lors de l'inscription";
        }
    } else {
        echo "Veuillez remplir tous les champs";
    }
}
?>
