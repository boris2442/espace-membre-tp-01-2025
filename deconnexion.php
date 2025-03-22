<?php
session_start();
if(! isset($_SESSION["user"])){
    header("location:connexion.php");
    exit;
}
unset($_SESSION["user"]);
header("location:inscription.php");



?>