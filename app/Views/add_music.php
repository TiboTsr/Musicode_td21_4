<?php
session_start();
// Redirection si non connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit;
}

// Connexion BDD
require_once __DIR__ . '/../db_connect.php';

$pageTitle = "Ajouter une musique - Musicode";
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données
    $titre = trim($_POST['titre'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $album = trim($_POST['album'] ?? '');
    $min = (int)($_POST['min'] ?? 0);
    $sec = (int)($_POST['sec'] ?? 0);

    if (empty($titre) || empty($artiste)) {
        $error = "Les champs Titre et Artiste sont obligatoires.";
    } else {
        // Formatage de la durée (ex: 03"03")
        $duree = sprintf('%02d"%02d"', $min, $sec);

        // Insertion dans la BDD
        $sql = "INSERT INTO musique (titre, auteur, album, duree) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$titre, $artiste, $album, $duree])) {
            // Redirection vers le catalogue après succès
            header('Location: catalogue.php');
            exit;
        } else {
            $error = "Erreur lors de l'enregistrement.";
        }
    }
}

require_once __DIR__ . '../includes/header.php';
?>

<main class="container main-content">
    
    <!-- Lien retour -->
    <div class="back-link-container">
        <a href="catalogue.php" class="back-link">← Retour au catalogue</a>
    </div>

    <!-- Contenu principal -->
    <div class="form-container">
        <h1 class="page-title">Ajouter une musique</h1>
        <p class="page-subtitle" style="margin-bottom: 2rem;">
            Complétez les informations ci-dessous pour publier un nouveau morceau dans le catalogue.
        </p>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="" method="POST" class="add-music-form">
            
            <!-- Titre -->
            <div class="form-group">
                <label for="titre">Titre *</label>
                <input type="text" id="titre" name="titre" required value="<?= htmlspecialchars($titre ?? '') ?>">
            </div>

            <!-- Artiste -->
            <div class="form-group">
                <label for="artiste">Artiste *</label>
                <input type="text" id="artiste" name="artiste" required value="<?= htmlspecialchars($artiste ?? '') ?>">
            </div>

            <!-- Album -->
            <div class="form-group">
                <label for="album">Album</label>
                <input type="text" id="album" name="album" placeholder="Optionnel" value="<?= htmlspecialchars($album ?? '') ?>">
            </div>

            <!-- Durée (Minutes : Secondes) -->
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

<?php require_once __DIR__ . '../includes/footer.php'; ?>
