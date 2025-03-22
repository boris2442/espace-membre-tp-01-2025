<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<!-- Barre de navigation -->
<nav class="bg-gray-900 text-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            
            <!-- Logo -->
            <a href="index.php" class="text-2xl font-bold flex items-center">
                <img src="logo.png" alt="Logo" class="w-10 h-10 mr-2">
                MonProjet
            </a>

            <!-- Bouton menu pour mobile -->
            <button id="menuBtn" class="lg:hidden text-white text-2xl">
                ☰
            </button>

            <!-- Liens de navigation -->
            <ul id="menu" class="hidden lg:flex space-x-6">
                <li><a href="index.php" class="hover:text-gray-400">Accueil</a></li>

                <?php if(isset($_SESSION['user'])): ?>
                    <li><a href="profil.php" class="hover:text-gray-400">Profil</a></li>
                    <li><a href="table.php" class="hover:text-gray-400">Liste des utilisateurs</a></li>
                    <li><a href="deconnexion.php" class="bg-red-500 px-4 py-2 rounded hover:bg-red-600">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="connexion.php" class="bg-green-500 px-4 py-2 rounded hover:bg-green-600">Se connecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Script pour le menu mobile -->
<script>
    document.getElementById('menuBtn').addEventListener('click', function() {
        document.getElementById('menu').classList.toggle('hidden');
    });
</script>

</body>
</html>
