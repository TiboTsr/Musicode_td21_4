<?php 
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
$pageTitle = "Catalogue - Musicode";
require_once __DIR__ . '/includes/header.php'; 
?>

<main class="container main-content">
    
    <?php if (!empty($message)): ?>
        <div class="alert-info" style="margin-bottom: 1.5rem;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="page-header-flex">
        <div>
            <h1 class="page-title">Catalogue des musiques</h1>
            <p class="page-subtitle">Découvrez les morceaux disponibles et ajoutez-les à votre bibliothèque.</p>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= $root ?>/ajouter" class="btn-new-music">
                <span style="margin-right: 5px; font-size: 1.2em; line-height: 1;">+</span> Nouvelle musique
            </a>
        <?php endif; ?>
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
                <a href="<?= $root ?>/musics/<?= $musique['id'] ?>" class="btn-link">
                    Voir la fiche
                </a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="<?= $root ?>/musics">
                        <input type="hidden" name="add_music_id" value="<?= $musique['id'] ?>">
                        <button type="submit" class="btn-add">
                            Ajouter
                        </button>
                    </form>
                <?php else: ?>
                    <span class="text-note">
                        Connectez-vous pour ajouter
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>