<?php 
$pageTitle = "Mon Compte - Musicode";
require_once __DIR__ . '/includes/header.php'; 
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

<?php require_once __DIR__ . '/includes/footer.php'; ?>