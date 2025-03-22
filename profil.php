
<?php
session_start();

// Supposons que $user contient les infos récupérées depuis la base de données
$_SESSION['user'] = [
    "id" => $user["id"],
    "name" => $user["name"],  // Vérifie si la colonne est bien "name" dans la BDD
    "email" => $user["email"]
];

header("Location: profil.php");
exit();

?>