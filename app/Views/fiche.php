<?php 
$pageTitle = htmlspecialchars($musique['titre']) . " - Musicode";
require_once __DIR__ . '/includes/header.php'; 
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
?>

<main class="container main-content">
    <div class="back-link-container">
        <a href="<?= $root ?>/musics" class="back-link">← Retour au catalogue</a>
    </div>

    <?php if (!empty($message)): ?>
        <p class="success-message" style="color: green; margin-bottom: 15px;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <div class="detail-card">
        <h1 class="detail-title"><?= htmlspecialchars($musique['titre']) ?></h1>
        <p class="detail-artist">Par <?= htmlspecialchars($musique['auteur']) ?></p>
        
        <div class="detail-meta">
            <p>Album : <span class="meta-value"><?= htmlspecialchars($musique['album']) ?></span></p>
            <p>Durée : <span class="meta-value"><?= htmlspecialchars($musique['duree']) ?></span></p>
        </div>

        <div class="detail-actions">
            <form action="<?= $root ?>/musics/<?= $musique['id'] ?>" method="POST">
                <input type="hidden" name="add_to_collection" value="<?= $musique['id'] ?>">
                <button type="submit" class="btn-primary">Ajouter à ma bibliothèque</button>
            </form>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>