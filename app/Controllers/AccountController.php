<?php
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ' . $root . '/login');; exit; }

require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/../Models/UserModel.php';

$userId = $_SESSION['user_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = trim($_POST['nom_affichage']);
    $newPass = !empty($_POST['new_password']) ? password_hash($_POST['new_password'], PASSWORD_DEFAULT) : null;
    
    if (updateUser($pdo, $userId, $newName, $newPass)) {
        $_SESSION['user_name'] = $newName;
        $message = "Profil mis à jour.";
    }
}

$user = getUserById($pdo, $userId);
include __DIR__ . '/../Views/account.php';