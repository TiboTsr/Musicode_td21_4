<?php
session_start();

// Titre de la page
$pageTitle = "Musicode - Connexion";

// Message d'erreur éventuel
$error = "";

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Exemple ultra-simple : login en dur (à remplacer par une vérif en BDD)
    $validEmail = "user@example.com";
    // Mot de passe "secret123" haché avec password_hash()
    $validHash = '$2y$10$ABCDEFGHIJKLMNOPQRSTUV1234567890abcdefghi'; // à remplacer par un vrai hash

    if ($email === $validEmail && password_verify($password, $validHash)) { // [web:7]
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

    <div class="card" style="max-width: 400px; margin: 0 auto;">
        <?php if (!empty($error)): ?>
            <p style="color:#dc2626; font-size:0.875rem; margin-top:0; margin-bottom:1rem;">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="post" action="">
            <div style="display:flex; flex-direction:column; gap:0.75rem;">
                <div>
                    <label for="email" style="font-size:0.875rem; color:#374151; display:block; margin-bottom:0.25rem;">
                        Adresse e-mail
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        autocomplete="username"
                        style="width:100%; padding:0.5rem 0.75rem; border-radius:0.5rem; border:1px solid #e5e7eb;"
                    >
                </div>

                <div>
                    <label for="password" style="font-size:0.875rem; color:#374151; display:block; margin-bottom:0.25rem;">
                        Mot de passe
                    </label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        style="width:100%; padding:0.5rem 0.75rem; border-radius:0.5rem; border:1px solid #e5e7eb;"
                    >
                </div>

                <button
                    type="submit"
                    class="btn-link"
                    style="margin-top:0.75rem; padding:0.5rem 0.75rem; border-radius:0.5rem; border:none; background-color:#0891b2; color:white; cursor:pointer;"
                >
                    Se connecter
                </button>
            </div>
        </form>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>
