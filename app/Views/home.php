<?php
$pageTitle = "Musicode - Catalogue";

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

// Inclusion du header
require_once 'includes/header.php';
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

<?php require_once 'includes/footer.php'; ?>
