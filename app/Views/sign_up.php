<?php
$pageTitle = "Inscription - Musicode";
require_once __DIR__ . '/includes/header.php';
?>

<main class="main-content flex-center">
    
    <div class="auth-card">
        <h1 class="auth-title">Inscription</h1>

        <form action="" method="POST" class="auth-form">
            
            <div class="form-group">
                <label for="username">Nom d'affichage</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirmer le mot de passe</label>
                <input type="password" id="password_confirm" name="password_confirm" required>
            </div>

            <button type="submit" class="btn-submit">Créer mon compte</button>
        </form>

        <div class="auth-footer">
            <p>Déjà inscrit ? <a href="login.php" class="text-link">Se connecter.</a></p>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>