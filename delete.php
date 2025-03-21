<?php

require_once "./database/connexion.php";

// Récupération des données du formulaire
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM `users` WHERE id = :id";
    $requete = $db->prepare($sql);
    $requete->bindParam(":id", $id);
    $requete->execute();
    header("Location: table.php");
}else{
    die("Utilisateur introuvable");
}


?>