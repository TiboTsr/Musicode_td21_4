<?php
session_start();
$pageTitle = "Inscription - Musicode";
require_once __DIR__ . '/../db_connect.php';

$error = "";
$success = "";
$registered = false;

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
                $success = "Compte créé avec succès.";
                $registered = true;
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

        <form id="register-form" action="" method="POST" class="auth-form">
            
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

        <!-- Confirmation modal -->
        <div id="confirm-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:9998;" aria-hidden="true"></div>
        <div id="confirm-modal" role="dialog" aria-modal="true" aria-labelledby="confirm-title" style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%,-50%); background:#fff; padding:20px; border-radius:8px; box-shadow:0 10px 30px rgba(0,0,0,0.2); z-index:9999; width:90%; max-width:420px;">
            <h2 id="confirm-title" style="margin-top:0; font-size:1.1em;">Confirmer l'inscription</h2>
            <p style="margin:8px 0; color:#333;">Voulez-vous confirmer la création du compte avec ces informations&nbsp;?</p>
            <ul style="list-style:none; padding:0; margin:10px 0; color:#222;">
                <li><strong>Nom&nbsp;:</strong> <span id="confirm-username"></span></li>
                <li><strong>Email&nbsp;:</strong> <span id="confirm-email"></span></li>
            </ul>
            <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px;">
                <button id="confirm-cancel" type="button" class="btn-submit" style="background:#e5e7eb; color:#111;">Annuler</button>
                <button id="confirm-ok" type="button" class="btn-submit btn-pink">Confirmer</button>
            </div>
        </div>

        <!-- Success modal (after registration) -->
        <div id="success-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.4); z-index:9998;" aria-hidden="true"></div>
        <div id="success-modal" role="dialog" aria-modal="true" aria-labelledby="success-title" style="display:none; position:fixed; left:50%; top:50%; transform:translate(-50%,-50%); background:#fff; padding:20px; border-radius:8px; box-shadow:0 10px 30px rgba(0,0,0,0.2); z-index:9999; width:90%; max-width:420px;">
            <h2 id="success-title" style="margin-top:0; font-size:1.1em;">Inscription réussie</h2>
            <p style="margin:8px 0; color:#333;">Votre compte a été créé avec succès. Vous pouvez vous connecter maintenant.</p>
            <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:14px;">
                <button id="success-ok" type="button" class="btn-submit btn-pink">Aller à la connexion</button>
            </div>
        </div>

        <div class="auth-footer">
            <p>Déjà inscrit ? <a href="login.php" class="text-link">Se connecter.</a></p>
        </div>
    </div>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

<script>
(function(){
    const form = document.getElementById('register-form');
    if (!form) return;

    const overlay = document.getElementById('confirm-overlay');
    const modal = document.getElementById('confirm-modal');
    const confirmUsername = document.getElementById('confirm-username');
    const confirmEmail = document.getElementById('confirm-email');
    const btnCancel = document.getElementById('confirm-cancel');
    const btnOk = document.getElementById('confirm-ok');

    function showModal() {
        overlay.style.display = 'block';
        modal.style.display = 'block';
        btnCancel.focus();
        document.body.style.overflow = 'hidden';
    }

    function hideModal() {
        overlay.style.display = 'none';
        modal.style.display = 'none';
        document.body.style.overflow = '';
    }

    form.addEventListener('submit', function(e){
        if (window._registerConfirmed) {
            window._registerConfirmed = false;
            return;
        }
        e.preventDefault();

        const username = form.querySelector('#username') ? form.querySelector('#username').value : '';
        const email = form.querySelector('#email') ? form.querySelector('#email').value : '';
        confirmUsername.textContent = username || '-';
        confirmEmail.textContent = email || '-';

        showModal();
    });

    btnCancel.addEventListener('click', function(){ hideModal(); });

    btnOk.addEventListener('click', function(){
        window._registerConfirmed = true;
        hideModal();
        form.submit();
    });

    overlay.addEventListener('click', hideModal);
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape' && modal.style.display === 'block') hideModal(); });
})();

// Success modal behaviour
(function(){
    const successOverlay = document.getElementById('success-overlay');
    const successModal = document.getElementById('success-modal');
    const btnGoto = document.getElementById('success-ok');

    if (!successModal) return;

    function showSuccess() {
        successOverlay.style.display = 'block';
        successModal.style.display = 'block';
        btnGoto.focus();
        document.body.style.overflow = 'hidden';
        window._successRedirectTimeout = setTimeout(function(){ window.location.href = 'login.php'; }, 6000);
    }

    function hideSuccess() {
        successOverlay.style.display = 'none';
        successModal.style.display = 'none';
        document.body.style.overflow = '';
        if (window._successRedirectTimeout) clearTimeout(window._successRedirectTimeout);
    }

    btnGoto.addEventListener('click', function(){ window.location.href = 'login.php'; });
    successOverlay.addEventListener('click', function(){ hideSuccess(); });
    document.addEventListener('keydown', function(e){ if (e.key === 'Escape' && successModal.style.display === 'block') hideSuccess(); });

    var registerSuccess = <?php echo json_encode(!empty($success)); ?>;
    if (registerSuccess) showSuccess();
})();
</script>