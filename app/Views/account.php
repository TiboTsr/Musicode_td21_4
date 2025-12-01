<?php
session_start();
$pageTitle = "Mon compte - Musicode";
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../db_connect.php';

$message = "";
$messageType = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = trim($_POST['nom_affichage'] ?? '');
    $newPass = $_POST['new_password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';
    $userId = $_SESSION['user_id'];

    if (empty($newName)) {
        $message = "Le nom d'affichage ne peut pas être vide.";
        $messageType = "error";
    } else {
        if (!empty($newPass)) {
            if ($newPass !== $confirm) {
                $message = "Les mots de passe ne correspondent pas.";
                $messageType = "error";
            } else {
                $hash = password_hash($newPass, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE UTILISATEUR SET nom_affichage = ?, motdepasse = ? WHERE id = ?");
                if ($stmt->execute([$newName, $hash, $userId])) {
                    $message = "Compte mis à jour avec succès.";
                    $messageType = "success";
                    $_SESSION['user_name'] = $newName;
                }
            }
        } 
        else {
            $stmt = $pdo->prepare("UPDATE UTILISATEUR SET nom_affichage = ? WHERE id = ?");
            if ($stmt->execute([$newName, $userId])) {
                $message = "Informations mises à jour.";
                $messageType = "success";
                $_SESSION['user_name'] = $newName;
            }
        }
    }
}
$stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

require_once 'includes/header.php';
?>

<main class="main-content flex-center">
    
    <div class="auth-card account-card">
        <h1 class="auth-title">Mon compte</h1>

        <?php if ($message): ?>
            <div class="alert <?= $messageType ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="" class="auth-form">
            
            <div class="form-group">
                <label for="nom_affichage">Nom d'affichage</label>
                <input type="text" id="nom_affichage" name="nom_affichage" 
                       value="<?= htmlspecialchars($user['nom_affichage']) ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group col-half">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password">
                </div>

                <div class="form-group col-half">
                    <label for="confirm_password">Confirmation</label>
                    <input type="password" id="confirm_password" name="confirm_password">
                </div>
            </div>
            
            <p class="form-help">Laissez vide pour conserver l'actuel.</p>

            <button type="submit" class="btn-submit btn-pink">Mettre à jour</button>
        </form>
    </div>

</main>

<?php require_once 'includes/footer.php'; ?>