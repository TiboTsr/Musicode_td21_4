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
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (getUserByEmail($pdo, $email)) {
        $error = "Cet email est déjà utilisé.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if (createUser($pdo, $username, $email, $hash)) {
            header('Location: ' . $root . '/login');
            exit;
        }
    }
}
include __DIR__ . '/../Views/register.php';