<?php
require_once "./database/connexion.php";

$sql = "SELECT * FROM `users`";
$requete = $db->prepare($sql);
$requete->execute();
$users = $requete->fetchAll(PDO::FETCH_ASSOC);







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
    <h1>Listes des utilisateurs</h1>
    <table class="border-2 border-solid border-green-500">
        <thead>
            <tr>
                <th class="border-2 border-solid border-green-500">Id</th>
                <th class="border-2 border-solid border-green-500">Name</th>
                <th class="border-2 border-solid border-green-500">Surname</th>
                <th class="border-2 border-solid border-green-500">email</th>
                <th class="border-2 border-solid border-green-500">password</th>
                <th class="border-2 border-solid border-green-500">images</th>
                <th class="border-2 border-solid border-green-500">sexe</th>
                <th class="border-2 border-solid border-green-500">languages</th>
                <th class="border-2 border-solid border-green-500">continent</th>
                <th class="border-2 border-solid border-green-500">Modifier</th>
                <th class="border-2 border-solid border-green-500">Supprimer</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user):
            ?>
                <tr>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["id"]) ?></td>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["name"]) ?></td>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["surname"]) ?></td>

                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["email"]) ?></td>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["password"])   ?></td>
                    <td class="border-2 border-solid border-green-500">
                        <img src="data:image/png;base64,<?php echo base64_encode($user['images'] ?? ''); ?>"
                            alt="Image de <?php echo htmlspecialchars($user['name'] ?? ''); ?>"
                            style="width: 100px; height: auto;">
                    </td>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["sexe"])  ?></td>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["language"])   ?></td>
                    <td class="border-2 border-solid border-green-500"><?php echo htmlspecialchars($user["continent"])  ?></td>
                    <td class="border-2 border-solid border-green-500"><a href="update.php:id=<?php echo $user["id"]    ?> name='update' ">Modifier</a></td>
                    <td class="border-2 border-solid border-green-500"><a href="delete.php:id=<?php $user["id"]  ?> name='delete' ">Delete</a></td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>