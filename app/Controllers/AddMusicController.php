<?php
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ' . $root . '/login');
    exit;
}

require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/../Models/MusicModel.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = trim($_POST['titre'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $album = trim($_POST['album'] ?? '');
    $min = (int)($_POST['min'] ?? 0);
    $sec = (int)($_POST['sec'] ?? 0);

    if (empty($titre) || empty($artiste)) {
        $error = "Les champs Titre et Artiste sont obligatoires.";
    } else {
        $userId = $_SESSION['user_id']; 
        $duree = sprintf('00:%02d:%02d', $min, $sec);
        if (addMusic($pdo, $titre, $artiste, $album, $duree, $userId)) {
            header('Location: ' . $root . '/musics');
            exit;
        } else {
            $error = "Erreur lors de l'enregistrement.";
        }
    }
}

include __DIR__ . '/../Views/add_music.php';