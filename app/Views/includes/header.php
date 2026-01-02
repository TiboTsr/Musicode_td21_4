<!DOCTYPE html>
<?php 
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Musicode' ?></title>
    
    <link rel="stylesheet" href="<?= $root ?>/app/css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="container nav-content">
            <a href="<?= $root ?>/musics" class="logo">
                <span class="logo-icon">▶</span>
                Musicode
            </a>
            
            <ul class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="<?= $root ?>/musics">Catalogue</a></li>
                    <li><a href="<?= $root ?>/ajouter">Ajouter une musique</a></li>
                    <li><a href="<?= $root ?>/library">Ma Bibliothèque</a></li>
                    <li><a href="<?= $root ?>/account">Mon Compte</a></li>
                    <li><a href="<?= $root ?>/logout" class="btn-logout">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="<?= $root ?>/musics">Catalogue</a></li>
                    <li><a href="<?= $root ?>/login">Connexion</a></li>
                    <li><a href="<?= $root ?>/register" class="btn-pink" style="padding: 0.5rem 1rem; border-radius: 0.5rem; color: white;">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </header>