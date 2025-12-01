<?php
session_start();
$pageTitle = "Catalogue des musiques";

require_once __DIR__ . '/../db_connect.php';

$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_music_id'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }

    $musicId = $_POST['add_music_id'];
    $userId = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("INSERT INTO COLLECTION (utilisateur_id, musique_id, note) VALUES (?, ?, 0)");
        $stmt->execute([$userId, $musicId]);
        $message = "Musique ajoutée à votre bibliothèque !";
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $message = "Cette musique est déjà dans votre bibliothèque.";
        } else {
            $message = "Erreur : " . $e->getMessage();
        }
    }
}

$sql = "SELECT * FROM MUSIQUE";
$stmt = $pdo->query($sql);
$musiques = $stmt->fetchAll();

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
            <a href="add_music.php" class="btn-new-music">
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
                <a href="fiche.php?id=<?= $musique['id'] ?>" class="btn-link">
                    Voir la fiche
                </a>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <form method="POST" action="">
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