<?php
// 1. Connexion à la base de données
// On utilise le même chemin relatif que dans votre home.php
require_once __DIR__ . '/../db_connect.php';

// 2. Validation de l'ID reçu dans l'URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// 3. Récupération de la musique spécifique
if ($id) {
    // On prépare la requête pour éviter les injections SQL
    $sql = "SELECT * FROM musique WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $musique = $stmt->fetch();
} else {
    $musique = false;
}

// 4. Redirection si l'ID est invalide ou si la musique n'existe pas
if (!$musique) {
    header('Location: home.php');
    exit;
}

// 5. Configuration de la page
$pageTitle = $musique['titre'] . " - Musicode";
require_once __DIR__ . '/includes/header.php';
?>

    <main class="container main-content">
        
        <!-- Lien retour -->
        <div class="back-link-container">
            <!-- On retourne vers la page d'où l'on vient -->
            <a href="home.php" class="back-link">← Retour au catalogue</a>
        </div>

        <!-- Carte Détail -->
        <div class="detail-card">
            <h1 class="detail-title"><?= htmlspecialchars($musique['titre']) ?></h1>
            
            <!-- Note : J'utilise 'auteur' ici car c'est ce que vous avez mis dans votre boucle foreach -->
            <p class="detail-artist">Par <?= htmlspecialchars($musique['auteur']) ?></p>
            
            <div class="detail-meta">
                <p>Album : <span class="meta-value"><?= htmlspecialchars($musique['album']) ?></span></p>
                <p>Durée : <span class="meta-value"><?= htmlspecialchars($musique['duree']) ?></span></p>
            </div>

            <div class="detail-actions">
                <button class="btn-primary">Ajouter à ma bibliothèque</button>
            </div>
        </div>

    </main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
