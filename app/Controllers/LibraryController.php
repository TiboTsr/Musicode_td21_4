<?php
$root = dirname($_SERVER['SCRIPT_NAME']); 
if ($root === DIRECTORY_SEPARATOR || $root === '.') {
    $root = '';
}
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ' . $root . '/login');; exit; }

require_once __DIR__ . '/../db_connect.php';
require_once __DIR__ . '/../Models/CollectionModel.php';

$userId = $_SESSION['user_id'];
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mId = $_POST['musique_id'];
    if ($_POST['action'] === 'update_note') {
        updateCollectionNote($pdo, $userId, $mId, $_POST['note']);
        $message = "Note mise à jour.";
    } elseif ($_POST['action'] === 'remove') {
        removeFromCollection($pdo, $userId, $mId);
        $message = "Musique retirée.";
    }
}

$myCollection = getUserCollection($pdo, $userId);
include __DIR__ . '/../Views/library.php';