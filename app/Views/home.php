<?php
$musiques = [
    [
        'titre' => 'Bohemian Rhapsody',
        'artiste' => 'Queen',
        'album' => 'A Night at the Opera',
        'duree' => '05"54"',
        'id' => 1
    ],
    [
        'titre' => 'Imagine',
        'artiste' => 'John Lennon',
        'album' => 'Imagine',
        'duree' => '03"03"',
        'id' => 2
    ],
    [
        'titre' => 'Stairway to Heaven',
        'artiste' => 'Led Zeppelin',
        'album' => 'Led Zeppelin IV',
        'duree' => '08"02"',
        'id' => 3
    ]
];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicode - Catalogue</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

    <nav class="navbar">
        <div class="container nav-content">
            <a href="#" class="logo">
                <div class="logo-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24" width="20" height="20">
                        <path d="M8 5v14l11-7z"/>
                    </svg>
                </div>
                <span>Musicode</span>
            </a>

            <ul class="nav-links">
                <li><a href="#">Catalogue</a></li>
                <li><a href="#">Connexion</a></li>
                <li><a href="#">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <main class="container main-content">
        
        <div class="page-header">
            <h1 class="page-title">Catalogue des musiques</h1>
            <p class="page-subtitle">Découvrez les morceaux disponibles et ajoutez-les à votre bibliothèque.</p>
        </div>

        <div class="music-grid">
            
            <?php foreach ($musiques as $musique): ?>
            <div class="card">
                <h2 class="card-title">
                    <?= htmlspecialchars($musique['titre']) ?>
                </h2>
                
                <p class="card-info">
                    <?= htmlspecialchars($musique['artiste']) ?> · Album : <?= htmlspecialchars($musique['album']) ?>
                </p>
                
                <p class="card-duration">
                    Durée : <?= htmlspecialchars($musique['duree']) ?>
                </p>
                
                <div class="card-footer">
                    <a href="fiche.php?id=<?= $musique['id'] ?>" class="btn-link">
                        Voir la fiche
                    </a>
                    <span class="text-note">
                        Connectez-vous pour ajouter
                    </span>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </main>

    <footer class="site-footer">
        <div class="container">
            <p>&copy; 2025 Musicode - IUT Laval - R3.01 Développement web 2025-2026.</p>
        </div>
    </footer>

</body>
</html>