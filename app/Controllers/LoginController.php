<?php
session_start();
require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/../Models/UserModel.php';
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $user = getUserByEmail($pdo, $email);

    if ($user && password_verify($password, $user['motdepasse'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nom_affichage'];
        header('Location: ' . $root . '/musics');
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
include __DIR__ . '/../Views/login.php';