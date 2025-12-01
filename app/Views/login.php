<?php
session_start();
$pageTitle = "Musicode - Connexion";
$error = "";
require_once __DIR__ . '/../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Veuillez remplir tous les champs.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['motdepasse'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nom_affichage'];
            header('Location: catalogue.php');
            exit;
        } else {
            $error = "Email ou mot de passe incorrect.";
        }
    }
}

require_once 'includes/header.php';
?>

<main class="main-content flex-center">
    <div class="auth-card">
        <h1 class="auth-title">Connexion</h1>
        <p style="text-align:center; color:#6b7280; margin-bottom:1.5rem;">Accédez à votre bibliothèque Musicode.</p>

    <div class="card card-login">
        <?php if (!empty($error)): ?>
            <p class="form-error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="" class="auth-form">
            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn-submit">Se connecter</button>
        </form>
        
        <div class="auth-footer">
            <p>Pas encore de compte ? <a href="sign_up.php" class="text-link">S'inscrire.</a></p>
        </div>
    </div>
</main>

<?php require_once 'includes/footer.php'; ?>