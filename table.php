<?php
require_once "./database/connexion.php";

$sql = "SELECT * FROM `users`";
$requete = $db->prepare($sql);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_ASSOC);







?>







<?php
require_once './require/header.php';
?>

<h1>Listes des utilisateurs</h1>
<table class="border-2 border-solid border-green-500">
    <thead>
        <tr>
            <th class="border-2 border-solid border-green-500 p-[9px]">Id</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">Name</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">Surname</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">email</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">password</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">images</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">sexe</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">languages</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">continent</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">Modifier</th>
            <th class="border-2 border-solid border-green-500 p-[9px]">Supprimer</th>

        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($users as $user):
        ?>
            <tr>
                <td class="border-2 border-solid border-green-500"><?php echo ($user["id"]) ?></td>
                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["name"]) ?></td>
                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["surname"]) ?></td>

                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["email"]) ?></td>
                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["password"])   ?></td>
                <td class="border-2 border-solid border-green-500">
                    <img src="data:image/png;base64,<?php echo base64_encode($user['images'] ?? ''); ?>"
                        alt="Image de <?php echo htmlspecialchars($user['name'] ?? ''); ?>"
                        style="width: 80px; height: 80px;" class="object-cover">
                </td>
                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["sexe"])  ?></td>
                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["language"])   ?></td>
                <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["continent"])  ?></td>
                <td class="border-2 border-solid border-green-500">
                    <a href="update.php?id=<?php echo urlencode($user['id']); ?>" name="update">Update</a>
                </td>
                <td class="border-2 border-solid border-green-500">
                    <a href="delete.php?id=<?php echo urlencode($user['id']); ?>" name="delete">Delete</a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<?php
require_once "./require/footer.php";
?>