<?php 
$pageTitle = "Connexion - Musicode";
require_once __DIR__ . '/includes/header.php'; 
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
?>

<main class="main-content flex-center">
    <div class="auth-card">
        <h1 class="auth-title">Connexion</h1>

        <?php if (!empty($error)): ?>
            <p class="form-error" style="color: #ef4444; background-color: #fee2e2; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form">
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>
        </form>

        <div class="auth-footer">
            <p>Pas encore de compte ? <a href="<?= $root ?>/register" class="text-link">Créer un compte.</a></p>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>