<?php
session_start();

// Titre de la page
$pageTitle = "Musicode - Connexion";

$error = "";

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // TODO : remplacer par une vérification en base avec password_hash/password_verify
    $validEmail = "user@example.com";
    // Faux hash d'exemple, à remplacer par un vrai
    $validHash = '$2y$10$ABCDEFGHIJKLMNOPQRSTUV1234567890abcdefghi';

    if ($email === $validEmail && password_verify($password, $validHash)) { // [web:10][web:49]
        $_SESSION['user_email'] = $email;
        header('Location: catalogue.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}

// Inclusion du header
require_once 'includes/header.php';
?>

<main class="container main-content">
    <div class="page-header">
        <h1 class="page-title">Connexion</h1>
        <p class="page-subtitle">Accédez à votre bibliothèque Musicode.</p>
    </div>

    <div class="card card-login">
        <?php if (!empty($error)): ?>
            <p class="form-error">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    autocomplete="username"
                    class="form-input"
                >
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="form-input"
                >
            </div>

            <button type="submit" class="btn-primary">
                Se connecter
            </button>
        </form>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
