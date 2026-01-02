<?php 
$pageTitle = "Ma Bibliothèque - Musicode";
require_once __DIR__ . '/includes/header.php'; 
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
?>

<main class="container main-content">
    
    <?php if (!empty($message)): ?>
        <div class="alert-info">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="page-header">
        <h1 class="page-title">Ma bibliothèque</h1>
        <p class="page-subtitle">Gérez vos morceaux préférés et ajustez vos notes.</p>
    </div>

    <?php if (empty($myCollection)): ?>
        <p style="text-align:center; color:#6b7280; margin-top: 2rem;">
            Votre bibliothèque est vide. <a href="<?= $root ?>/musics" class="text-link">Ajouter des musiques</a>.
        </p>
    <?php else: ?>
        
        <div class="music-grid">
            <?php foreach ($myCollection as $musique): ?>
                <div class="card">
                    <h2 class="card-title"><?= htmlspecialchars($musique['titre']) ?></h2>
                    <p class="card-info">
                        <?= htmlspecialchars($musique['auteur']) ?> · Album : <?= htmlspecialchars($musique['album']) ?>
                    </p>
                    <p class="card-duration">Durée : <?= htmlspecialchars($musique['duree']) ?></p>

                    <form method="POST" action="">
                        <input type="hidden" name="musique_id" value="<?= $musique['id'] ?>">

                        <div class="note-control">
                            <label class="note-label">Note</label>
                            <input type="number" name="note" value="<?= $musique['note'] ?>" min="0" max="5" class="note-input">
                            <button type="submit" name="action" value="update_note" class="btn-update">
                                Mettre à jour
                            </button>
                        </div>

                        <button type="submit" name="action" value="remove" class="btn-remove">
                            Retirer de ma bibliothèque
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>