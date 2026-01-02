<?php 
$pageTitle = "Ajouter une musique - Musicode";
require_once __DIR__ . '/includes/header.php'; 
?>

<main class="container main-content">

    <div class="back-link-container">
        <a href="musics.php" class="back-link">← Retour au catalogue</a>
    </div>

    <div class="form-container">
        <h1 class="page-title">Ajouter une musique</h1>
        <p class="page-subtitle" style="margin-bottom: 2rem;">
            Complétez les informations ci-dessous pour publier un nouveau morceau dans le catalogue.
        </p>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="" method="POST" class="add-music-form">

            <div class="form-group">
                <label for="titre">Titre *</label>
                <input type="text" id="titre" name="titre" required value="<?= htmlspecialchars($titre ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="artiste">Artiste *</label>
                <input type="text" id="artiste" name="artiste" required value="<?= htmlspecialchars($artiste ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="album">Album</label>
                <input type="text" id="album" name="album" placeholder="Optionnel" value="<?= htmlspecialchars($album ?? '') ?>">
            </div>

            <div class="form-group">
                <label>Durée *</label>
                <div class="duration-inputs">
                    <div class="duration-field">
                        <input type="number" name="min" min="0" max="59" value="3" required>
                        <span class="duration-label">Minutes</span>
                    </div>
                    <span class="duration-separator">:</span>
                    <div class="duration-field">
                        <input type="number" name="sec" min="0" max="59" value="0" required>
                        <span class="duration-label">Secondes</span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn-submit btn-primary-action">
                Enregistrer la musique
            </button>

        </form>
    </div>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>