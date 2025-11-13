<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Musicode - Catalogue</title>
    <link rel="stylesheet" href="public\assets\css\style.css"> 
</head>
<body>

    <header class="app-header">
        <div class="logo">
            <span class="logo-icon">▶</span> Musicode
        </div>
        <nav class="nav-links">
            <a href="/musics" class="active">Catalogue</a>
            <a href="/login">Connexion</a>
            <a href="/register">Inscription</a>
        </nav>
    </header>

    <main class="container">
        <section class="catalogue-header">
            <h1>Catalogue des musiques</h1>
            <p>Découvrez les morceaux disponibles et ajoutez-les à votre bibliothèque.</p>
        </section>

        <div class="music-list">
            <?php
            $musics = [
                ['title' => 'Bohemian Rhapsody', 'artist' => 'Queen', 'album' => 'A Night at the Opera', 'duration' => '05\'54'],
                ['title' => 'Imagine', 'artist' => 'John Lennon', 'album' => 'Imagine', 'duration' => '03\'03'],
                ['title' => 'Stairway to Heaven', 'artist' => 'Led Zeppelin', 'album' => 'Led Zeppelin IV', 'duration' => '08\'02']
            ];

            foreach ($musics as $music) {
                echo '<article class="music-card">';
                echo '    <h2>' . htmlspecialchars($music['title']) . '</h2>';
                echo '    <p class="details">' . htmlspecialchars($music['artist']) . ' · Album : ' . htmlspecialchars($music['album']) . '</p>';
                echo '    <p class="duration">Durée : ' . htmlspecialchars($music['duration']) . '</p>';
                echo '    <div class="card-actions">';
                echo '        <a href="/musics/{id}" class="action-link">Voir la fiche</a>'; 
                echo '        <span class="add-prompt">Connectez-vous pour ajouter</span>'; 
                echo '    </div>';
                echo '</article>';
            }
            ?>
        </div>
    </main>

    <footer class="app-footer">
        © 2025 Musicode · IUT Laval · R3.01 Développement web 2025-2026.
    </footer>

</body>
</html>