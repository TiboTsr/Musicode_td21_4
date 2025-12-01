<?php
// Vous pouvez définir une variable $pageTitle dans chaque page avant l'include
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
            <a href="home.php" class="logo">
                <div class="logo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
                <span>Musicode</span>
            </a>

            <ul class="nav-links">
                <li><a href="#">Catalogue</a></li>
                <li><a href="login.php">Connexion</a></li>
                <li><a href="sign_up.php">Inscription</a></li>
            </ul>
        </div>
    </nav>
