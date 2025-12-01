<?php
require_once __DIR__ . '/../db_connect.php';
$sql = "SELECT * FROM musique";
$stmt = $pdo->query($sql);
$musiques = $stmt->fetchAll();
$pageTitle = "Catalogue des musiques";
require_once __DIR__ . '/includes/header.php';
?>

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
                    <?= htmlspecialchars($musique['auteur']) ?> · Album : <?= htmlspecialchars($musique['album']) ?>
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