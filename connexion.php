<?php
session_start();
//je souhaite que mon utilisateur se connecte avec le mot de passe et le mail
//je verifie si le formulaire a ete soumis
if (!empty($_POST)) {
    
    if (
        !empty($_POST['email']) && !empty($_POST['password'])
        &&  isset($_POST['email'], $_POST['password'])
        ) {
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                die("ce n'est pas un email");
            }
    
            require_once "./database/connexion.php";
    
            $sql = "SELECT* FROM  `users` WHERE `email`=:email";
    
            $requete = $db->prepare($sql);
            $requete->bindValue(":email", $_POST['email'], PDO::PARAM_STR);
            $requete->execute();
            $user = $requete->fetch();
    
            if (!$user) {
                die("l'utilisateur et ou le mot de passe est incorect");
            }
      
    
            if (!password_verify($_POST["password"], $user["password"])) {
                die("l'utilisateur et ou le mot de passe est incorrect");
            }
       
            $_SESSION["user"] = [
                "id" => $user["id"],
                "pseudo" => $user["name"],
                "email" => $user["email"]
            ];
    
            echo "connexion reussie avec successful";

    
            header("location:profil.php");
    }
}
?>

<?php
require_once './require/header.php';

?>
<h1>Connectez vous!</h1>
<form action="" method="post">
    <div class="pl-[100px] pt-[100px] flex flex-col gap-[20px]">
        <div class="flex flex-col gap-[2px]">
            <label for="email" class="">Enter your email</label>
            <input type="email" name="email" id="email" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="aubinborissimotsebo@gmail.com" required>
        </div>
        <div class="flex flex-col gap-[2px]">
            <label for="password" class="">Enter your password</label>
            <input type="password" name="password" id="password" class="w-[300px] border-2 border-solid border-green-500 p-[7px]" placeholder="Bafoussam@%$" required>
        </div>
        <button type="submit" name="submit" class="w-[300px] bg-green-500 text-white p-[7px] rounded-md">Se connecter</button>
    </div>
</form>
<?php
require_once "./require/footer.php";
?>