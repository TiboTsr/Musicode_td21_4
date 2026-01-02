<?php
session_start();
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/../Models/MusicModel.php';
require_once __DIR__ . '/../Models/CollectionModel.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header('Location: ' . $basePath . '/musics');
    exit;
}
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_collection'])) {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . $root . '/login');
        exit;
    }

    try {
        addToCollection($pdo, $_SESSION['user_id'], $_POST['add_to_collection']);
        $message = "La musique a été ajoutée à votre bibliothèque !";
    } catch (Exception $e) {
        $message = "Cette musique est déjà dans votre collection.";
    }
}
if ($id) {
    $musique = getMusicById($pdo, $id);
} else {
    $musique = false;
}

if (!$musique) {
    header('Location: ' . $root . '/musics/' . $id);
    exit;
}

include __DIR__ . '/../Views/fiche.php';