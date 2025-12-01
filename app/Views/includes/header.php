<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($pageTitle)) {
    $pageTitle = "Musicode";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="../css/style.css"> 
</head>
<body>

    <nav class="navbar">
        <div class="container nav-content">
            <a href="<?= isset($_SESSION['user_id']) ? 'catalogue.php' : 'home.php' ?>" class="logo">
                <div class="logo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
                <span>Musicode</span>
            </a>

            <ul class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="catalogue.php">Catalogue</a></li>
                    <li><a href="add_music.php">Ajouter une musique</a></li>
                    <li><a href="my_library.php">Ma bibliothèque</a></li>
                    <li><a href="account.php">Mon compte</a></li>
                    <li>
                        <a href="logout.php" class="btn-logout">Déconnexion</a>
                    </li>

                <?php else: ?>
                    <li><a href="catalogue.php">Catalogue</a></li>
                    <li><a href="login.php">Connexion</a></li>
                    <li><a href="sign_up.php">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>