<?php
session_start();
$pageTitle = "Ma bibliothèque - Musicode";


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../db_connect.php';

$userId = $_SESSION['user_id'];
$message = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $musiqueId = $_POST['musique_id'] ?? null;
    $action = $_POST['action'] ?? '';

    if ($musiqueId) {
        if ($action === 'update_note') {

            $note = intval($_POST['note']);

            if ($note < 0) $note = 0;
            if ($note > 5) $note = 5;

            $stmt = $pdo->prepare("UPDATE COLLECTION SET note = ? WHERE utilisateur_id = ? AND musique_id = ?");
            $stmt->execute([$note, $userId, $musiqueId]);
            $message = "Votre note a été mise à jour.";
        } 
        elseif ($action === 'remove') {

            $stmt = $pdo->prepare("DELETE FROM COLLECTION WHERE utilisateur_id = ? AND musique_id = ?");
            $stmt->execute([$userId, $musiqueId]);
            $message = "Musique retirée de votre bibliothèque.";
        }
    }
}

$sql = "SELECT m.*, c.note 
        FROM MUSIQUE m
        JOIN COLLECTION c ON m.id = c.musique_id
        WHERE c.utilisateur_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$userId]);
$myCollection = $stmt->fetchAll();

require_once 'includes/header.php';
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
            Votre bibliothèque est vide. <a href="catalogue.php" class="text-link">Ajouter des musiques</a>.
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

<?php require_once 'includes/footer.php'; ?>