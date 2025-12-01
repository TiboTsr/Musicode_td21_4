<?php
session_start();
$pageTitle = "Inscription - Musicode";
require_once __DIR__ . '/../db_connect.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['password_confirm'] ?? '';

    if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
        $error = "Veuillez remplir tous les champs.";
    } 
    elseif ($password !== $confirm) {
        $error = "Les mots de passe ne correspondent pas.";
    } 
    else {
        $stmt = $pdo->prepare("SELECT id FROM UTILISATEUR WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error = "Cet email est déjà utilisé par un autre compte.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insertSql = "INSERT INTO UTILISATEUR (nom_affichage, email, motdepasse) VALUES (?, ?, ?)";
            $insertStmt = $pdo->prepare($insertSql);
            
            if ($insertStmt->execute([$username, $email, $hash])) {
                header('Location: login.php');
                exit;
            } else {
                $error = "Une erreur est survenue lors de la création du compte.";
            }
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<main class="main-content flex-center">
    
    <div class="auth-card">
        <h1 class="auth-title">Inscription</h1>

        <?php if ($error): ?>
            <div style="color: #ef4444; background-color: #fee2e2; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-size: 0.9em;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" class="auth-form">
            
            <div class="form-group">
                <label for="username">Nom d'affichage</label>
                <input type="text" id="username" name="username" required value="<?= htmlspecialchars($username ?? '') ?>">
            </div>

            <div class="form-group">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">
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